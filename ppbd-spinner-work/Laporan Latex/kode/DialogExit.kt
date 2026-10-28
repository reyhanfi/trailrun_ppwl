package com.example.presensiapp

import android.app.Dialog
import android.os.Bundle
import androidx.appcompat.app.AlertDialog
import androidx.fragment.app.DialogFragment
import com.example.presensiapp.databinding.DialogExitBinding

class DialogExit : DialogFragment() {
    override fun onCreateDialog(savedInstanceState: Bundle?): Dialog {
        val binding = DialogExitBinding.inflate(layoutInflater)
        val dialog = AlertDialog.Builder(requireContext()).setView(binding.root).create()
        binding.buttonYa.setOnClickListener { requireActivity().finish() }
        binding.buttonTidak.setOnClickListener { dismiss() }
        return dialog
    }
}
