<script setup>
    // Import ref dan onMounted
    import { ref, onMounted } from 'vue';

    // Import api
    import api from '../../api';

    // Define state untuk menyimpan data reviews
    const reviews = ref([]);

    // Method fetchDataReviews
    const fetchDataReviews = async () => {
        // Fetch data reviews
        await api.get('/api/reviews')
        .then(response => {
            // Set data response ke state "reviews"
            reviews.value = response.data.data.data;
        });
    }

    // Run hook "onMounted"
    onMounted(() => {
        // Panggil method "fetchDataReviews"
        fetchDataReviews();
    });

    // Method deleteReview
    const deleteReview = async (id) => {
        // Delete review dengan API
        await api.delete(`/api/reviews/${id}`)
        .then(() => {
            // Panggil method "fetchDataReviews" setelah berhasil dihapus
            fetchDataReviews();
        });
    };
</script>

<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'reviews.create' }" class="btn btn-md btn-success rounded shadow border-0 mb-3">ADD NEW REVIEW</router-link>
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">User</th>
                                    <th scope="col">Review</th>
                                    <th scope="col">House</th>
                                    <th scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="reviews.length == 0">
                                    <td colspan="4" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            Data Belum Tersedia!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(review, index) in reviews" :key="index">
                                    <td>{{ review.user.name }}</td>
                                    <td>{{ review.review }}</td>
                                    <td>{{ review.rumah.name }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'reviews.edit', params:{id: review.id} }" class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">EDIT</router-link>
                                        <button @click.prevent="deleteReview(review.id)" class="btn btn-sm btn-danger rounded-sm shadow border-0">DELETE</button>
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
