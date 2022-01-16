package com.android.dimassdoubles.sambongmarket;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.Locale;

public class CheckoutActivity extends AppCompatActivity {
    private static final String TAG = CheckoutActivity.class.getSimpleName();

//    int totalHarga = DashboardActivity.totalHarga;
    public static int totalOngkir, totalBayar;
    public static TextView tvTotalPesanan, tvOngkir, tvTotalBayar;
    RecyclerView mRecyclerView;
    PesananAdapter mAdapter;
    Button btnOngkir, btnCheckout;

    public static ArrayList<ProdukItem> listPesanan;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_checkout);
        listPesanan = DashboardActivity.listPesanan;

        mRecyclerView = findViewById(R.id.pesananRecyclerView);
        mAdapter = new PesananAdapter(CheckoutActivity.this, DashboardActivity.listPesanan);
        mRecyclerView.setAdapter(mAdapter);
        mRecyclerView.setLayoutManager(new LinearLayoutManager(getBaseContext()));

        totalOngkir = 0;

        tvTotalPesanan = findViewById(R.id.tvTotalPesanan);
        tvOngkir = findViewById(R.id.tvOngkir);
        tvTotalBayar = findViewById(R.id.tvTotalBayar);
        btnOngkir = findViewById(R.id.btnOngkir);
        btnCheckout = findViewById(R.id.btnCheckout);

        tvTotalPesanan.setText("Rp " + String.format(Locale.GERMAN, "%,d", DashboardActivity.totalHarga));
        tvTotalBayar.setText("Rp " + String.format(Locale.GERMAN, "%,d", DashboardActivity.totalHarga));

        btnOngkir.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(CheckoutActivity.this, CekOngkirActivity.class);
                startActivity(intent);
            }
        });

        btnCheckout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                int totalBayar = DashboardActivity.totalHarga + totalOngkir;
                Intent intent = new Intent(CheckoutActivity.this, BayarActivity.class);
                intent.putExtra("total", totalBayar);
                intent.putExtra("ongkir", totalOngkir);
                startActivity(intent);
            }
        });

    }

    public static void set_ongkir(int ongkir) {
        totalOngkir = ongkir;
        tvOngkir.setText("Rp " + String.format(Locale.GERMAN, "%,d", totalOngkir));
        tvTotalBayar.setText("Rp " + String.format(Locale.GERMAN, "%,d", (DashboardActivity.totalHarga + totalOngkir)));
    }
}
