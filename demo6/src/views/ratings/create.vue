<script setup>
    //import ref
    import { ref } from "vue";
 
    //import router
    import { useRouter } from 'vue-router';
 
    //import api
    import api from "../../api";
 
    //init router
    const router = useRouter();
 
    //define state
    const rumah_id = ref("");
    const user_id = ref("");
    const rating = ref("");
    const errors = ref([]);
 
    //method "storeRating"
    const storeRating = async () => {
        //init formData
        let formData = new FormData();
 
        //assign state value to formData
        formData.append("rumah_id", rumah_id.value);
        formData.append("user_id", user_id.value);
        formData.append("rating", rating.value);
 
        //store data with API
        await api.post('/api/ratings', formData)
        .then(() => {
            //redirect
            router.push({ path: "/ratings" });
        })
        .catch((error) => {
            //assign response error data to state "errors"
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
                        <form @submit.prevent="storeRating()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Rumah ID</label>
                                <input type="number" class="form-control" v-model="rumah_id" placeholder="Masukkan ID Rumah">
                                <div v-if="errors.rumah_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.rumah_id[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">User ID</label>
                                <input type="number" class="form-control" v-model="user_id" placeholder="Masukkan ID Pengguna">
                                <div v-if="errors.user_id" class="alert alert-danger mt-2">
                                    <span>{{ errors.user_id[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Rating</label>
                                <input type="number" class="form-control" v-model="rating" placeholder="Masukkan Rating (1-5)" min="1" max="5">
                                <div v-if="errors.rating" class="alert alert-danger mt-2">
                                    <span>{{ errors.rating[0] }}</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
