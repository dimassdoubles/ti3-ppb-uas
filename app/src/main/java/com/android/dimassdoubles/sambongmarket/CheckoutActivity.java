package com.android.dimassdoubles.sambongmarket;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;
import android.widget.Button;
import android.widget.TextView;

import java.util.Locale;

public class CheckoutActivity extends AppCompatActivity {
    private static final String TAG = CheckoutActivity.class.getSimpleName();

//    int totalHarga = DashboardActivity.totalHarga;
    int ongkir, totalBayar;
    TextView tvTotalPesanan, tvOngkir, tvTotalBayar;
    RecyclerView mRecyclerView;
    PesananAdapter mAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_checkout);

        mRecyclerView = findViewById(R.id.pesananRecyclerView);
        mAdapter = new PesananAdapter(CheckoutActivity.this, DashboardActivity.listPesanan);
        mRecyclerView.setAdapter(mAdapter);
        mRecyclerView.setLayoutManager(new LinearLayoutManager(getBaseContext()));

        ongkir = 0;

        tvTotalPesanan = findViewById(R.id.tvTotalPesanan);
        tvOngkir = findViewById(R.id.tvOngkir);
        tvTotalBayar = findViewById(R.id.tvTotalBayar);

        tvTotalPesanan.setText("Rp " + String.format(Locale.GERMAN, "%,d", DashboardActivity.totalHarga));
        tvTotalBayar.setText("Rp " + String.format(Locale.GERMAN, "%,d", DashboardActivity.totalHarga));

    }
}
