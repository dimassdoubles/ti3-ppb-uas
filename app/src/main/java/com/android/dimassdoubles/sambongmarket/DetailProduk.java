package com.android.dimassdoubles.sambongmarket;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

public class DetailProduk extends AppCompatActivity {
    private static final String TAG = DetailProduk.class.getSimpleName();

    String deskripsiProduk = "";
    TextView tvDeskripsi;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_produk);

        deskripsiProduk = getIntent().getStringExtra(ProdukAdapter.EXTRA_DESKRIPSI);
//        Log.d(TAG, "onCreate: " + deskripsiProduk);

        tvDeskripsi = findViewById(R.id.tvDeskripsi);
//        Log.d(TAG, "onCreate: #cek 1");
        tvDeskripsi.setText(deskripsiProduk);
    }
}
