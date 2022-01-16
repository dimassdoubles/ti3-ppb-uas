package com.android.dimassdoubles.sambongmarket;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.loader.content.AsyncTaskLoader;

import android.content.AsyncQueryHandler;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Environment;
import android.os.FileUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.androidnetworking.AndroidNetworking;
import com.androidnetworking.common.Priority;
import com.androidnetworking.error.ANError;
import com.androidnetworking.interfaces.JSONObjectRequestListener;
import com.google.firebase.auth.FirebaseAuth;
import com.itextpdf.text.BaseColor;
import com.itextpdf.text.Chunk;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Element;
import com.itextpdf.text.Font;
import com.itextpdf.text.PageSize;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.pdf.BaseFont;
import com.itextpdf.text.pdf.PdfWriter;
import com.itextpdf.text.pdf.draw.LineSeparator;


import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.Locale;
import java.util.Objects;

import static android.Manifest.permission.READ_EXTERNAL_STORAGE;
import static android.Manifest.permission.WRITE_EXTERNAL_STORAGE;

import org.json.JSONObject;

public class BayarActivity extends AppCompatActivity {
    private static final String TAG = BayarActivity.class.getSimpleName();

    Button btnUpload, btnKonfirmasi;
    ImageView imgBukti;
    TextView tvTotalBayar;

    int totalBayar;

    // constant to compare
    // the activity result code
    int SELECT_PICTURE = 200;

    // constant code for runtime permissions
    private static final int PERMISSION_REQUEST_CODE = 200;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_bayar);

        btnUpload = findViewById(R.id.btnUpload);
        imgBukti = findViewById(R.id.imgBukti);
        tvTotalBayar = findViewById(R.id.tvTotalBayar);
        btnKonfirmasi = findViewById(R.id.btnKonfirmasi);

        totalBayar = getIntent().getIntExtra("total", 0);
        tvTotalBayar.setText("Rp " + String.format(Locale.GERMAN, "%,d", totalBayar));

        btnUpload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                imageChooser();
            }
        });

        btnKonfirmasi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // below code is used for
                // checking our permissions.
                if (checkPermission()) {
                    Toast.makeText(BayarActivity.this, "Permission Granted", Toast.LENGTH_SHORT).show();
                } else {
                    requestPermission();
                }
                Log.d(TAG, "onClick: #cek 1");
                Log.d(TAG, "onClick: " + Objects.requireNonNull(FirebaseAuth.getInstance().getCurrentUser()).getEmail());
                cetakPdf();
                new insertPesanan().execute();
            }
        });
    }

    private class insertPesanan extends AsyncTask<Void, Void, Void> {
        @Override
        protected Void doInBackground(Void... voids) {
            try {
                Log.d(TAG, "doInBackground: #cek2");
                String deskripsi_pesanan = "";
                for (int i=0; i<CheckoutActivity.listPesanan.size()-1; i++) {
                    deskripsi_pesanan += CheckoutActivity.listPesanan.get(i).getNama_produk() + " " + CheckoutActivity.listPesanan.get(i).getJumlah_pesan() + " (" + (CheckoutActivity.listPesanan.get(i).getJumlah_pesan()*CheckoutActivity.listPesanan.get(i).getHarga()) +"), ";
                }
                Log.d(TAG, "doInBackground: #cek3");
                deskripsi_pesanan += CheckoutActivity.listPesanan.get(CheckoutActivity.listPesanan.size() - 1).getNama_produk() + " " + CheckoutActivity.listPesanan.get(CheckoutActivity.listPesanan.size() - 1).getJumlah_pesan() + " (" + (CheckoutActivity.listPesanan.get(CheckoutActivity.listPesanan.size() - 1).getJumlah_pesan() * CheckoutActivity.listPesanan.get(CheckoutActivity.listPesanan.size() - 1).getHarga()) + "), ";
                deskripsi_pesanan += "ongkir (" + getIntent().getIntExtra("ongkir", 0) + ").";
                Log.d(TAG, "doInBackground: " + deskripsi_pesanan);

                AndroidNetworking.post("http://192.168.43.160/PPB_10/php/penjualan/insert.php")
                        .addBodyParameter("email_konsumen", FirebaseAuth.getInstance().getCurrentUser().getEmail())
                        .addBodyParameter("deskripsi_pesanan", deskripsi_pesanan)
                        .addBodyParameter("total_pesanan", String.valueOf(totalBayar))
                        .setPriority(Priority.MEDIUM)
                        .build()
                        .getAsJSONObject(new JSONObjectRequestListener() {
                            @Override
                            public void onResponse(JSONObject response) {
                                Log.d(TAG, "onResponse: berhasil");
                            }

                            @Override
                            public void onError(ANError anError) {
                                Log.d(TAG, "onError: gagal");
                            }
                        });

            } catch (Exception e) {
                Log.d(TAG, "doInBackground: #cek1");
                Log.d(TAG, "doInBackground: " + e.getMessage());

            }

            return null;
        }

    }

    private void cetakPdf() {
        SimpleDateFormat s = new SimpleDateFormat("ddMMyyhhmmss");
        String format = s.format(new Date());
        SimpleDateFormat s2 = new SimpleDateFormat("EEE, d MMM yyyy HH:mm:ss");
        String format2 = s2.format(new Date());

        Document doc = new Document();
        File file = new File(Environment.getExternalStorageDirectory(), "Nota-" + format + ".pdf");
        Log.d(TAG, "cetakPdf: #cek12");

        try {
            PdfWriter.getInstance(doc, new FileOutputStream(file));
            doc.open();

            // document settings
            doc.setPageSize(PageSize.A4);
            doc.addCreationDate();
            doc.addAuthor("Dimas 12497");
            doc.addCreator("Dimas 12497");

            BaseFont urName = BaseFont.createFont(BaseFont.HELVETICA, "UTF-8", BaseFont.EMBEDDED);

            BaseColor mColorAccent = new BaseColor(0, 153, 204, 255);

            float mHeadingFontSize = 20.0f;
            float mValueFontSize = 26.0f;

            Font mTitleFont = new Font(urName, 36.0f, Font.NORMAL, BaseColor.BLACK);
            Font mHeadingFont = new Font(urName, mHeadingFontSize, Font.NORMAL, mColorAccent);
            Font mValueFont = new Font(urName, mValueFontSize, Font.NORMAL, BaseColor.BLACK);

            // line separator
            LineSeparator lineSeparator = new LineSeparator();
            lineSeparator.setLineColor(new BaseColor(0, 0, 0, 68));

            // order details
            // title
            Chunk mTitleChunk = new Chunk("Invoice", mTitleFont);
            Paragraph mTitleParagraph = new Paragraph(mTitleChunk);
            mTitleParagraph.setAlignment(Element.ALIGN_CENTER);

            // adding line breakable space
            doc.add(new Paragraph(""));
            // adding horizontal line
            doc.add(new Chunk(lineSeparator));
            // adding line breakable space
            doc.add(new Paragraph(""));

            // tanggal
            Chunk mDateChunk = new Chunk("Order Date: ", mHeadingFont);
            Paragraph mOrderDateParagraph = new Paragraph(mDateChunk);
            doc.add(mOrderDateParagraph);
            Chunk mDateValueChunk = new Chunk(format2, mValueFont);
            Paragraph mDateValueParagraph = new Paragraph(mDateValueChunk);
            doc.add(mDateValueParagraph);

            doc.add(new Paragraph(""));
            doc.add(new Chunk(lineSeparator));
            doc.add(new Paragraph(""));

            // akun
            Chunk mAcNameChunk = new Chunk("Account Email: ", mHeadingFont);
            Paragraph mAcNameParagraph = new Paragraph(mAcNameChunk);
            doc.add(mAcNameChunk);

            Chunk mAcNameValueChunk = new Chunk(Objects.requireNonNull(FirebaseAuth.getInstance().getCurrentUser().getEmail()), mValueFont);
            Paragraph mAcNameValueParagraph = new Paragraph(mAcNameValueChunk);
            doc.add(mAcNameValueParagraph);

            doc.add(new Paragraph(""));
            doc.add(new Chunk(lineSeparator));
            doc.add(new Paragraph(""));

            // total
            Chunk mAmountChunk = new Chunk("Total Amount: ", mHeadingFont);
            Paragraph mAmountParagraph = new Paragraph(mAmountChunk);
            doc.add(mAmountParagraph);

            Chunk mAmountValueChunk = new Chunk ("Rp " + String.format(Locale.GERMAN, "%,d", totalBayar), mValueFont);
            Paragraph mAmountValueParagraph = new Paragraph(mAmountValueChunk);
            doc.add(mAmountValueParagraph);

            doc.add(new Paragraph(""));
            doc.add(new Chunk(lineSeparator));
            doc.add(new Paragraph(""));

            doc.close();
            Log.d(TAG, "cetakPdf: berhasil");

        } catch (FileNotFoundException e) {
            Log.d(TAG, "cetakPdf: gagal");
            e.printStackTrace();
        } catch (DocumentException e) {
            Log.d(TAG, "cetakPdf: gagal");
            e.printStackTrace();
        } catch (IOException e) {
            Log.d(TAG, "cetakPdf: gagal");
            e.printStackTrace();
        }


    }

    // this function is triggered when
    // the Select Image Button is clicked
    void imageChooser() {

        // create an instance of the
        // intent of the type image
        Intent i = new Intent();
        i.setType("image/*");
        i.setAction(Intent.ACTION_GET_CONTENT);

        // pass the constant to compare it
        // with the returned requestCode
        startActivityForResult(Intent.createChooser(i, "Select Picture"), SELECT_PICTURE);
    }

    // this function is triggered when user
    // selects the image from the imageChooser
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        if (resultCode == RESULT_OK) {

            // compare the resultCode with the
            // SELECT_PICTURE constant
            if (requestCode == SELECT_PICTURE) {
                // Get the url of the image from data
                Uri selectedImageUri = data.getData();
                if (null != selectedImageUri) {
                    // update the preview image in the layout
                    imgBukti.setImageURI(selectedImageUri);
                }
            }
        }
    }

    private boolean checkPermission() {
        // checking of permissions.
        int permission1 = ContextCompat.checkSelfPermission(getApplicationContext(), WRITE_EXTERNAL_STORAGE);
        int permission2 = ContextCompat.checkSelfPermission(getApplicationContext(), READ_EXTERNAL_STORAGE);
        return permission1 == PackageManager.PERMISSION_GRANTED && permission2 == PackageManager.PERMISSION_GRANTED;
    }

    private void requestPermission() {
        // requesting permissions if not provided.
        ActivityCompat.requestPermissions(this, new String[]{WRITE_EXTERNAL_STORAGE, READ_EXTERNAL_STORAGE}, PERMISSION_REQUEST_CODE);
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode == PERMISSION_REQUEST_CODE) {
            if (grantResults.length > 0) {

                // after requesting permissions we are showing
                // users a toast message of permission granted.
                boolean writeStorage = grantResults[0] == PackageManager.PERMISSION_GRANTED;
                boolean readStorage = grantResults[1] == PackageManager.PERMISSION_GRANTED;

                if (writeStorage && readStorage) {
//                    Toast.makeText(this, "Permission Granted..", Toast.LENGTH_SHORT).show();
                } else {
//                    Toast.makeText(this, "Permission Denined.", Toast.LENGTH_SHORT).show();
                    finish();
                }
            }
        }
    }
}
