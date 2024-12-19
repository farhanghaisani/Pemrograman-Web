<script setup>
    // Import ref dan onMounted
    import { ref, onMounted } from 'vue';

    // Import api
    import api from '../../api';

    // Define state
    const rumahs = ref([]);

    // Method fetchDataRumahs
    const fetchDataRumahs = async () => {
        // Fetch data rumah
        await api.get('/api/rumahs')
        .then(response => {
            // Set data response ke state "rumahs"
            rumahs.value = response.data.data.data;
        });
    }

    // Run hook "onMounted"
    onMounted(() => {
        // Panggil method "fetchDataRumahs"
        fetchDataRumahs();
    });

    // Method deleteRumah
    const deleteRumah = async (id) => {
        // Delete rumah dengan API
        await api.delete(`/api/rumahs/${id}`)
        .then(() => {
            // Panggil method "fetchDataRumahs"
            fetchDataRumahs();
        })
    };
</script>

<template>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'rumahs.create' }" class="btn btn-md btn-success rounded shadow border-0 mb-3">ADD NEW HOUSE</router-link>
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price Range</th>
                                    <th scope="col">Location</th>
                                    <th scope="col" style="width:15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="rumahs.length == 0">
                                    <td colspan="6" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            Data Belum Tersedia!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(rumah, index) in rumahs" :key="index">
                                    <td class="text-center">
                                        <img :src="rumah.image" width="200" class="rounded-3"/>
                                    </td>
                                    <td>{{ rumah.name }}</td>
                                    <td>{{ rumah.description }}</td>
                                    <td>{{ rumah.price_range }}</td>
                                    <td>{{ rumah.location }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'rumahs.edit', params:{id: rumah.id} }" class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">EDIT</router-link>
                                        <button @click.prevent="deleteRumah(rumah.id)" class="btn btn-sm btn-danger rounded-sm shadow border-0">DELETE</button>
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
