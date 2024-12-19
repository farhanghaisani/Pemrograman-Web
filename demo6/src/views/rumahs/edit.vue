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
    const image = ref("");
    const name = ref("");
    const description = ref("");
    const price_range = ref("");
    const location = ref("");
    const errors = ref([]);

    // onMounted untuk fetch data rumah berdasarkan ID
    onMounted(async () => {
        // Ambil data detail rumah berdasarkan ID
        await api.get(`/api/rumahs/${route.params.id}`)
        .then(response => {
            // Set data response ke state
            name.value = response.data.data.name;
            description.value = response.data.data.description;
            price_range.value = response.data.data.price_range;
            location.value = response.data.data.location;
        });
    });

    // Method untuk menangani perubahan file
    const handleFileChange = (e) => {
        // Assign file ke state
        image.value = e.target.files[0];
    };

    // Method "updatePost" untuk update data rumah
    const updatePost = async () => {
        // Init formData
        let formData = new FormData();

        // Assign nilai state ke formData
        formData.append("image", image.value);
        formData.append("name", name.value);
        formData.append("description", description.value);
        formData.append("price_range", price_range.value);
        formData.append("location", location.value);
        formData.append("_method", "PATCH");

        // Kirim data dengan API
        await api.post(`/api/rumahs/${route.params.id}`, formData)
        .then(() => {
            // Redirect setelah berhasil
            router.push({ path: "/rumahs" });
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
                        <form @submit.prevent="updatePost">
                            <!-- Input Gambar -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Image</label>
                                <input type="file" class="form-control" @change="handleFileChange">
                                <div v-if="errors.image" class="alert alert-danger mt-2">
                                    <span>{{ errors.image[0] }}</span>
                                </div>
                            </div>

                            <!-- Input Nama Rumah -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control" v-model="name" placeholder="Name of Rumah">
                                <div v-if="errors.name" class="alert alert-danger mt-2">
                                    <span>{{ errors.name[0] }}</span>
                                </div>
                            </div>

                            <!-- Input Deskripsi Rumah -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea class="form-control" v-model="description" rows="5" placeholder="Description of Rumah"></textarea>
                                <div v-if="errors.description" class="alert alert-danger mt-2">
                                    <span>{{ errors.description[0] }}</span>
                                </div>
                            </div>

                            <!-- Input Price Range -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Price Range</label>
                                <input type="number" class="form-control" v-model="price_range" placeholder="Price Range (e.g., 500,000 - 1,000,000)">
                                <div v-if="errors.price_range" class="alert alert-danger mt-2">
                                    <span>{{ errors.price_range[0] }}</span>
                                </div>
                            </div>

                            <!-- Input Location -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Location</label>
                                <input type="text" class="form-control" v-model="location" placeholder="Location of Rumah">
                                <div v-if="errors.location" class="alert alert-danger mt-2">
                                    <span>{{ errors.location[0] }}</span>
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
