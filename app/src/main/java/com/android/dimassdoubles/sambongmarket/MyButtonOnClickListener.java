package com.android.dimassdoubles.sambongmarket;

import android.view.View;

public class MyButtonOnClickListener implements View.OnClickListener {
    private static final String TAG = View.OnClickListener.class.getSimpleName();

    int id_produk;
    String nama_produk;
    String deskripsi;
    int harga;
    String gambar;

    public MyButtonOnClickListener(int id_produk, String nama_produk, String deskripsi, int harga, String gambar) {
        this.id_produk = id_produk;
        this.nama_produk = nama_produk;
        this.deskripsi = deskripsi;
        this.harga = harga;
        this.gambar = gambar;
    }

    @Override
    public void onClick(View v) {

    }
}
