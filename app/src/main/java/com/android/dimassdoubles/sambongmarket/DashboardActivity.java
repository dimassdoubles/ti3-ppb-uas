package com.android.dimassdoubles.sambongmarket;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.GridLayoutManager;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;

public class DashboardActivity extends AppCompatActivity {
    private static final String TAG = MainActivity.class.getSimpleName();

//    public static final int REQUEST_EDIT = 1;
//    public static int REQUEST_ADD = -1;

    private ArrayList<ProdukItem> listProduk;
    private RecyclerView mRecyclerView;
    private ProdukAdapter mAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard);

        mRecyclerView = findViewById(R.id.recyclerView);



        new ReadTask().execute();
    }

    private class ReadTask extends AsyncTask<Void, Void, Void> {
        ArrayList<ProdukItem> listProduk;

        @Override
        protected Void doInBackground(Void... voids) {
            String hasil = null;
            InputStream is = null;

            // httppost
            try {
                // create a neat value objet to hold the URL
                URL url = new URL("http://192.168.43.160/PPB_10/php/uas/read.php");

                // open a connection
                HttpURLConnection connection = (HttpURLConnection) url.openConnection();

                // set the request method
                connection.setRequestMethod("POST");

                // set the request content-type header parameter
                connection.setRequestProperty("Content-Type", "application/json; utf-8");

                // set response format type
                connection.setRequestProperty("Accept", "application/json");

                // ensure the connection will be used to send content
                connection.setDoOutput(true);

                // read the response from input stream
                try {
                    BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream(), "iso-8859-1"), 8);
                    StringBuilder response = new StringBuilder();
                    String responseLine = "0";
                    while ((responseLine = reader.readLine()) != null) {
                        response.append(responseLine + "\n");
                    }
                    hasil = response.toString();
                    Log.d(TAG, hasil);
                } catch (Exception e) {
                    Log.d(TAG, e.getMessage());
                }


            } catch(Exception e) {
                Log.d(TAG, e.getMessage());
            }

            // parse json
            JSONArray jArr;
            ProdukItem barangDagang;
            int idProduk = 0;
            String namaProduk = null;
            String deskripsi = null;
            int harga = 0;
            String gambar = null;


            try {
                jArr = new JSONArray(hasil);
                listProduk = new ArrayList<ProdukItem>();
                for (int i=0; i<jArr.length(); i++) {
                    JSONObject json_data = jArr.getJSONObject(i);
                    idProduk = json_data.getInt("id_produk");
                    namaProduk = json_data.getString("nama_produk");
                    deskripsi = json_data.getString("deskripsi");
                    harga = json_data.getInt("harga");
                    gambar = json_data.getString("gambar");

                    Log.d(TAG, "doInBackground: " + namaProduk);
                    ProdukItem produkItem = new ProdukItem();
                    produkItem.setId_produk(idProduk);
                    produkItem.setNama_produk(namaProduk);
                    produkItem.setDeskripsi(deskripsi);
                    produkItem.setHarga(harga);
                    produkItem.setGambar(gambar);
                    listProduk.add(produkItem);
                }

            } catch (JSONException e) {
                Log.d(TAG, e.getMessage());
                Toast.makeText(getBaseContext(), "Data Tidak Ditemukan", Toast.LENGTH_SHORT).show();
            }




            return null;
        }

        @Override
        protected void onPostExecute(Void unused) {
            super.onPostExecute(unused);
            Log.d(TAG, "onPostExecute: " + listProduk.get(0).getNama_produk());
            Log.d(TAG, "onPostExecute: " + listProduk.get(1).getNama_produk());

            // Create recycler view
            mRecyclerView = findViewById(R.id.recyclerView);

            // create adapter and supply data to be dissplayed
            mAdapter = new ProdukAdapter(DashboardActivity.this, listProduk);

            // connect Adapter with RecyclerView
            mRecyclerView.setAdapter(mAdapter);

            // give RecyclerView a default layout manager
            mRecyclerView.setLayoutManager(new GridLayoutManager(getBaseContext(), 2));
        }
    }
}
