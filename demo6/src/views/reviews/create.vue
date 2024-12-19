<script setup>
// Import ref
import { ref } from "vue";

// Import router
import { useRouter } from 'vue-router';

// Import api
import api from "../../api";

// Init router
const router = useRouter();

// Define state
const rumah_id = ref("");
const user_id = ref("");
const review = ref("");
const errors = ref([]);

// Method for handle form submission
const storeReview = async () => {
    // Init formData
    let formData = new FormData();

    // Assign state value to formData
    formData.append("rumah_id", rumah_id.value);
    formData.append("user_id", user_id.value);
    formData.append("review", review.value);

    // Store data with API
    await api.post('/api/reviews', formData)
        .then(() => {
            // Redirect
            router.push({ path: "/reviews" });
        })
        .catch((error) => {
            // Assign response error data to state "errors"
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
                        <form @submit.prevent="storeReview">
                            <!-- Rumah ID Input -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Rumah ID</label>
                                <input type="number" class="form-control" v-model="rumah_id" placeholder="ID of Rumah">
                                <div v-if="errors.rumah_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.rumah_id[0] }}</span>
                                </div>
                            </div>

                            <!-- User ID Input -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">User ID</label>
                                <input type="number" class="form-control" v-model="user_id" placeholder="ID of User">
                                <div v-if="errors.user_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.user_id[0] }}</span>
                                </div>
                            </div>

                            <!-- Review Input -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Review</label>
                                <textarea class="form-control" v-model="review" rows="5"
                                    placeholder="Write your review"></textarea>
                                <div v-if="errors.review" class="alert alert-danger mt-2">
                                    <span>{{ errors.review[0] }}</span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="btn btn-md btn-primary rounded-sm shadow border-0">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
