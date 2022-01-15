package com.android.dimassdoubles.sambongmarket.api;

import com.android.dimassdoubles.sambongmarket.model.city.ItemCity;
import com.android.dimassdoubles.sambongmarket.model.cost.ItemCost;
import com.android.dimassdoubles.sambongmarket.model.province.ItemProvince;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.Headers;
import retrofit2.http.POST;
import retrofit2.http.Query;

public interface ApiService {

    // Province
    @GET("province")
    @Headers("key:23a47ec7f6a3f476a7a0fab1c93c9753")
    Call<ItemProvince> getProvince ();

    // City
    @GET("city")
    @Headers("key:23a47ec7f6a3f476a7a0fab1c93c9753")
    Call<ItemCity> getCity (@Query("province") String province);

    // Cost
    @FormUrlEncoded
    @POST("cost")
    Call<ItemCost> getCost (@Field("key") String Token,
                            @Field("origin") String origin,
                            @Field("destination") String destination,
                            @Field("weight") String weight,
                            @Field("courier") String courier);

}
