package com.android.dimassdoubles.sambongmarket;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

public class CheckoutActivity extends AppCompatActivity {

    int totalHarga = DashboardActivity.totalHarga;
    String deskripsiPesanan = DashboardActivity.deskripsiPesanan;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_checkout);
    }
}
