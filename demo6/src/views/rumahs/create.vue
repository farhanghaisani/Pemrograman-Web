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
    const image = ref("");
    const name = ref("");
    const description = ref("");
    const price_range = ref("");
    const location = ref("");
    const errors = ref([]);

    // Method for handle file changes
    const handleFileChange = (e) => {
        // Assign file to state
        image.value = e.target.files[0];
    };

    // Method "storePost"
    const storePost = async () => {
        // Init formData
        let formData = new FormData();

        // Assign state value to formData
        formData.append("image", image.value);
        formData.append("name", name.value);
        formData.append("description", description.value);
        formData.append("price_range", price_range.value);
        formData.append("location", location.value);

        // Store data with API
        await api.post('/api/rumahs', formData)
            .then(() => {
                // Redirect
                router.push({ path: "/rumahs" });
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
                        <form @submit.prevent="storePost">
                            <!-- Image Input -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Image</label>
                                <input type="file" class="form-control" @change="handleFileChange">
                                <div v-if="errors.image" class="alert alert-danger mt-2">
                                    <span>{{ errors.image[0] }}</span>
                                </div>
                            </div>

                            <!-- Name Input -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control" v-model="name" placeholder="Name of Rumah">
                                <div v-if="errors.name" class="alert alert-danger mt-2">
                                    <span>{{ errors.name[0] }}</span>
                                </div>
                            </div>

                            <!-- Description Input -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea class="form-control" v-model="description" rows="5" placeholder="Description of Rumah"></textarea>
                                <div v-if="errors.description" class="alert alert-danger mt-2">
                                    <span>{{ errors.description[0] }}</span>
                                </div>
                            </div>

                            <!-- Price Range Input -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price Range</label>
                                <input type="number" class="form-control" v-model="price_range" placeholder="Price Range (e.g., 500,000 - 1,000,000)">
                                <div v-if="errors.price_range" class="alert alert-danger mt-2">
                                    <span>{{ errors.price_range[0] }}</span>
                                </div>
                            </div>

                            <!-- Location Input -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Location</label>
                                <input type="text" class="form-control" v-model="location" placeholder="Location of Rumah">
                                <div v-if="errors.location" class="alert alert-danger mt-2">
                                    <span>{{ errors.location[0] }}</span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
