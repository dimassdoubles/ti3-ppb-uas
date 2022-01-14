package com.android.dimassdoubles.sambongmarket;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.media.Image;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.cardview.widget.CardView;
import androidx.recyclerview.widget.RecyclerView;

import java.util.ArrayList;
import java.util.Locale;

public class ProdukAdapter extends RecyclerView.Adapter<ProdukAdapter.ProdukViewHolder> {
    private static final String TAG = ProdukAdapter.class.getSimpleName();

    public static final String EXTRA_ID = "ID";
    public static final String EXTRA_NAMA = "NAMA";
    public static final String EXTRA_DESKRIPSI = "DESKRIPSI";
    public static final String EXTRA_HARGA = "HARGA";
    public static final String EXTRA_GAMBAR = "GAMBAR";

    private final LayoutInflater mInflater;
    private Context mContext;
    private ArrayList<ProdukItem> listProduk;

    public ProdukAdapter(Context mContext, ArrayList<ProdukItem> listProduk) {
        this.mInflater = LayoutInflater.from(mContext);
        this.listProduk = listProduk;
        this.mContext = mContext;
    }

    // custom view holder
    public static class ProdukViewHolder extends RecyclerView.ViewHolder {

        public final CardView cvProduk;
        public final TextView tvNama, tvHarga;
        public final ImageView imgProduk;

        public ProdukViewHolder(@NonNull View itemView) {
            super(itemView);
            cvProduk = (CardView) itemView.findViewById(R.id.cardView);
            imgProduk = (ImageView) itemView.findViewById(R.id.imgProduk);
            tvNama = (TextView) itemView.findViewById(R.id.tvNama);
            tvHarga = (TextView) itemView.findViewById(R.id.tvHarga);
        }
    }


    @NonNull
    @Override
    public ProdukAdapter.ProdukViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View itemView = mInflater.inflate(R.layout.produk_item, parent, false);
        return new ProdukViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull ProdukAdapter.ProdukViewHolder holder, int position) {
        ProdukItem current = listProduk.get(position);
        int currentId = current.getId_produk();
        String currentNama = current.getNama_produk();
        String currentDeskripsi = current.getDeskripsi();
        int currentHarga = current.getHarga();
        String currentGambar = current.getGambar();

        holder.tvNama.setText(currentNama);
        holder.tvHarga.setText("Rp " + String.format(Locale.GERMAN, "%,d", currentHarga));
        if (!currentGambar.equals("")) {
            // code untuk mengatur gambar produk
        }

        // keep a reference to the view holder for the click listener
        final ProdukViewHolder h = holder;
        // attach a click listener to the cardview
        holder.tvNama.setOnClickListener(new MyButtonOnClickListener(currentId, currentNama, currentDeskripsi, currentHarga, currentGambar) {
            @Override
            public void onClick(View v) {
                Log.d(TAG, "OnClick VHPos " + h.getAdapterPosition());
                Intent intent = new Intent(mContext, DetailProduk.class);
                intent.putExtra("POSITION", h.getAdapterPosition());
                intent.putExtra(EXTRA_ID, id_produk);
                intent.putExtra(EXTRA_NAMA, nama_produk);
                intent.putExtra(EXTRA_DESKRIPSI, deskripsi);
                intent.putExtra(EXTRA_HARGA, harga);
                intent.putExtra(EXTRA_GAMBAR, gambar);
                ((Activity) mContext).startActivity(intent);
            }
        });

        holder.imgProduk.setOnClickListener(new MyButtonOnClickListener(currentId, currentNama, currentDeskripsi, currentHarga, currentGambar) {
            @Override
            public void onClick(View v) {
                DashboardActivity.tambah_total(harga);
                ProdukItem produkDiklik = listProduk.get(h.getAdapterPosition());
                if (produkDiklik.getJumlah_pesan() == 0) {
                    DashboardActivity.listPesanan.add(produkDiklik);
                }
                produkDiklik.tambah_pesanan();
                Log.d(TAG, "onClick: " + listProduk.get((h.getAdapterPosition())).getNama_produk() + " dipesan " + listProduk.get((h.getAdapterPosition())).getJumlah_pesan() + " kali");
            }
        });
    }

    @Override
    public int getItemCount() {
        return listProduk.size();
    }
}
