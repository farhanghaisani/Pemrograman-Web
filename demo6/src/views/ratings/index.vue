<script setup>
    //import ref and onMounted
    import { ref, onMounted } from 'vue';
 
    //import api
    import api from '../../api';
 
    //define state
    const ratings = ref([]);
 
    //method fetchDataRatings
    const fetchDataRatings = async () => {
        //fetch data ratings
        await api.get('/api/ratings')
        .then(response => {
            //set response data to state "ratings"
            ratings.value = response.data.data.data;
        });
    }
 
    //run hook "onMounted"
    onMounted(() => {
        //call method "fetchDataRatings"
        fetchDataRatings();
    });
 
    //method deleteRating
    const deleteRating = async (id) => {
        //delete rating with API
        await api.delete(`/api/ratings/${id}`)
        .then(() => {
            //call method "fetchDataRatings"
            fetchDataRatings();
        })
    };
</script>

<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'ratings.create' }" class="btn btn-md btn-success rounded shadow border-0 mb-3">ADD NEW RATING</router-link>
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">Rumah ID</th>
                                    <th scope="col">User ID</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="ratings.length == 0">
                                    <td colspan="4" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            Data Belum Tersedia!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(rating, index) in ratings" :key="index">
                                    <td class="text-center">{{ rating.rumah_id }}</td>
                                    <td class="text-center">{{ rating.user_id }}</td>
                                    <td class="text-center">{{ rating.rating }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'ratings.edit', params:{id: rating.id} }" class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">EDIT</router-link>
                                        <button @click.prevent="deleteRating(rating.id)" class="btn btn-sm btn-danger rounded-sm shadow border-0">DELETE</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
