package com.example.presensiapp

import android.content.Context
import android.os.Bundle
import android.view.View
import android.view.inputmethod.InputMethodManager
import android.widget.AdapterView
import android.widget.ArrayAdapter
import android.widget.Toast
import androidx.activity.OnBackPressedCallback
import androidx.activity.enableEdgeToEdge
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.ViewCompat
import androidx.core.view.WindowInsetsCompat
import com.example.presensiapp.databinding.ActivityMainBinding
import java.util.Locale

class MainActivity : AppCompatActivity() {
    private lateinit var binding: ActivityMainBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)
        ViewCompat.setOnApplyWindowInsetsListener(binding.main) { view, insets ->
            val bars = insets.getInsets(WindowInsetsCompat.Type.systemBars())
            view.setPadding(bars.left, bars.top, bars.right, bars.bottom)
            insets
        }

        binding.timePicker.setIs24HourView(false)
        val daftarStatus = resources.getStringArray(R.array.status_presensi)
        val adapter = ArrayAdapter(this, android.R.layout.simple_spinner_item, daftarStatus)
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
        binding.spinnerStatus.adapter = adapter
        binding.spinnerStatus.onItemSelectedListener = object : AdapterView.OnItemSelectedListener {
            override fun onItemSelected(parent: AdapterView<*>?, view: View?, position: Int, id: Long) {
                val perluKeterangan = position != 0
                binding.labelKeterangan.visibility = if (perluKeterangan) View.VISIBLE else View.GONE
                binding.editKeterangan.visibility = if (perluKeterangan) View.VISIBLE else View.GONE
                if (!perluKeterangan) {
                    binding.editKeterangan.text.clear()
                    binding.editKeterangan.error = null
                }
            }
            override fun onNothingSelected(parent: AdapterView<*>?) = Unit
        }
        savedInstanceState?.getString("hasil_presensi")?.let {
            binding.textHasil.text = it
            binding.textHasil.visibility = View.VISIBLE
        }
        binding.buttonSubmit.setOnClickListener { submitPresensi() }
        binding.buttonKeluar.setOnClickListener { tampilkanDialogKeluar() }
        onBackPressedDispatcher.addCallback(this, object : OnBackPressedCallback(true) {
            override fun handleOnBackPressed() = tampilkanDialogKeluar()
        })
    }

    private fun submitPresensi() {
        val status = binding.spinnerStatus.selectedItem.toString()
        val keterangan = binding.editKeterangan.text.toString().trim()
        if (binding.spinnerStatus.selectedItemPosition != 0 && keterangan.isEmpty()) {
            binding.editKeterangan.error = getString(R.string.error_keterangan)
            binding.editKeterangan.requestFocus()
            return
        }
        binding.editKeterangan.error = null
        (getSystemService(Context.INPUT_METHOD_SERVICE) as InputMethodManager)
            .hideSoftInputFromWindow(binding.root.windowToken, 0)
        binding.editKeterangan.clearFocus()
        val tanggal = String.format(
            Locale("id", "ID"), "%02d/%02d/%04d",
            binding.datePicker.dayOfMonth, binding.datePicker.month + 1, binding.datePicker.year
        )
        val jam24 = binding.timePicker.hour
        val jam12 = if (jam24 % 12 == 0) 12 else jam24 % 12
        val waktu = String.format(
            Locale.US, "%02d:%02d %s", jam12,
            binding.timePicker.minute, if (jam24 < 12) "AM" else "PM"
        )
        val hasil = buildString {
            append("Presensi berhasil\nTanggal: $tanggal\nWaktu: $waktu\nStatus: $status")
            if (binding.spinnerStatus.selectedItemPosition != 0) append("\nKeterangan: $keterangan")
        }
        binding.textHasil.text = hasil
        binding.textHasil.visibility = View.VISIBLE
        Toast.makeText(this, "Presensi berhasil $tanggal, $waktu", Toast.LENGTH_LONG).show()
        binding.main.post { binding.main.smoothScrollTo(0, binding.content.height) }
    }

    private fun tampilkanDialogKeluar() {
        if (supportFragmentManager.findFragmentByTag("dialog_keluar") == null) {
            DialogExit().show(supportFragmentManager, "dialog_keluar")
        }
    }

    override fun onSaveInstanceState(outState: Bundle) {
        if (binding.textHasil.visibility == View.VISIBLE) {
            outState.putString("hasil_presensi", binding.textHasil.text.toString())
        }
        super.onSaveInstanceState(outState)
    }
}
