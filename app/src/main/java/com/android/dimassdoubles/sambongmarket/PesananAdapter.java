package com.android.dimassdoubles.sambongmarket;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import java.lang.reflect.Array;
import java.sql.ClientInfoStatus;
import java.util.ArrayList;

public class PesananAdapter extends RecyclerView.Adapter<PesananAdapter.PesananViewHolder> {

    private final LayoutInflater mInflater;
    private Context mContext;
    private ArrayList<ProdukItem> listPesanan;

    public PesananAdapter(Context mContext, ArrayList<ProdukItem> listPesanan) {
        this.mInflater = LayoutInflater.from(mContext);
        this.listPesanan = listPesanan;
        this.mContext = mContext;
    }

    // custom view holder
    public static class PesananViewHolder extends RecyclerView.ViewHolder {

        public final TextView tvNamaProduk, tvJumlahPesanan;

        public PesananViewHolder(@NonNull View itemView) {
            super(itemView);
            tvNamaProduk = itemView.findViewById(R.id.tvNamaProduk);
            tvJumlahPesanan = itemView.findViewById(R.id.tvJumlahPesanan);
        }
    }

    @NonNull
    @Override
    public PesananAdapter.PesananViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = mInflater.inflate(R.layout.pesanan_item, parent, false);
        return new PesananViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull PesananAdapter.PesananViewHolder holder, int position) {
        ProdukItem current = listPesanan.get(position);
        String namaProduk = current.getNama_produk();
        int jumlahPesanan = current.getJumlah_pesan();

        holder.tvNamaProduk.setText(namaProduk);
        holder.tvJumlahPesanan.setText(String.valueOf(jumlahPesanan));
    }

    @Override
    public int getItemCount() {
        return listPesanan.size();
    }


}
