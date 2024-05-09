<script setup>

//import ref and onMounted
import { ref, onMounted } from 'vue';

//import api
import api from '../../api';

//define state
const bonuses = ref([]);

//method fetchDataPosts
const fetchDataBonus = async () => {

    //fetch data 
    await api.get('/api/bonus')

        .then(response => {

            //set response data to state "bonuses"
            bonuses.value = response.data.data.data

        });
}

//run hook "onMounted"
onMounted(() => {

    //call method "fetchDataBonus"
    fetchDataBonus();
});

//method deletePost
const deleteBonus = async (id) => {
    await api.delete(`/api/bonus/${id}`)
        .then(() => {
            fetchDataBonus();
            window.alert('Data berhasil dihapus!');
        })
        .catch((error) => {
            console.error('Error deleting bonus data:', error);
            window.alert('Data tidak terhapus. Silahkan coba lagi.');
        });
};


</script>

<template>
    <div>
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">VUE 3 + PHP 8.1 LARAVEL 10 : Rizki Nugroho</h1>
                <p class="col-md-8 fs-4">CODING CHALLENGE : Menentukan nilai rata-rata penghasilan.</p>
            </div>
        </div>
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <router-link :to="{ name: 'bonus.create' }"
                        class="btn btn-md btn-primary rounded shadow border-0 mb-3">Add New</router-link>
                    <div class="card border-0 rounded shadow">
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Buruh A</th>
                                        <th class="text-center">Bonus</th>
                                        <th class="text-center">Buruh B</th>
                                        <th class="text-center">Bonus</th>
                                        <th class="text-center">Buruh C</th>
                                        <th class="text-center">Bonus</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="bonuses.length == 0">
                                        <td colspan="7" class="text-center">
                                            <div class="alert alert-danger mb-0">
                                                Data Belum Tersedia!
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-else v-for="(bonus, index) in bonuses" :key="index">
                                        <td class="text-center">{{ bonus.employee1 }}</td>
                                        <td class="text-center">{{ (bonus.percentage1 * 100).toFixed(2) }}%</td>
                                        <td class="text-center">{{ bonus.employee2 }}</td>
                                        <td class="text-center">{{ (bonus.percentage2 * 100).toFixed(2) }}%</td>
                                        <td class="text-center">{{ bonus.employee3 }}</td>
                                        <td class="text-center">{{ (bonus.percentage3 * 100).toFixed(2) }}%</td>
                                        <td class="text-center">
                                            <router-link :to="{ name: 'bonus.show', params: { id: bonus.id } }"
                                                class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">Show</router-link>
                                            <router-link :to="{ name: 'bonus.edit', params: { id: bonus.id } }"
                                                class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">Edit</router-link>
                                            <button @click.prevent="deleteBonus(bonus.id)"
                                                class="btn btn-sm btn-danger rounded-sm shadow border-0">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>