<script setup>
    // Import ref dan onMounted
    import { ref, onMounted } from "vue";

    // Import router dan route
    import { useRouter, useRoute } from 'vue-router';

    // Import api
    import api from "../../api";

    // Init router
    const router = useRouter();

    // Init route
    const route = useRoute();

    // Define state
    const rumah_id = ref("");
    const user_id = ref("");
    const review = ref("");
    const errors = ref([]);

    // onMounted untuk fetch data review berdasarkan ID
    onMounted(async () => {
        // Ambil data detail review berdasarkan ID
        await api.get(`/api/reviews/${route.params.id}`)
        .then(response => {
            // Set data response ke state
            rumah_id.value = response.data.data.rumah_id;
            user_id.value = response.data.data.user_id;
            review.value = response.data.data.review;
        });
    });

    // Method untuk "updateReview" untuk update data review
    const updateReview = async () => {
        // Init formData
        let formData = new FormData();

        // Assign nilai state ke formData
        formData.append("rumah_id", rumah_id.value);
        formData.append("user_id", user_id.value);
        formData.append("review", review.value);
        formData.append("_method", "PATCH");

        // Kirim data dengan API
        await api.post(`/api/reviews/${route.params.id}`, formData)
        .then(() => {
            // Redirect setelah berhasil
            router.push({ path: "/reviews" });
        })
        .catch((error) => {
            // Assign data error response ke state "errors"
            errors.value = error.response.data;
        });
    };
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="updateReview">
                            <!-- Input Rumah ID -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Rumah ID</label>
                                <input type="text" class="form-control" v-model="rumah_id" placeholder="ID of Rumah" disabled>
                                <div v-if="errors.rumah_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.rumah_id[0] }}</span>
                                </div>
                            </div>

                            <!-- Input User ID -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">User ID</label>
                                <input type="text" class="form-control" v-model="user_id" placeholder="ID of User" disabled>
                                <div v-if="errors.user_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.user_id[0] }}</span>
                                </div>
                            </div>

                            <!-- Input Review -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Review</label>
                                <textarea class="form-control" v-model="review" rows="5" placeholder="Write your review"></textarea>
                                <div v-if="errors.review" class="alert alert-danger mt-2">
                                    <span>{{ errors.review[0] }}</span>
                                </div>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
