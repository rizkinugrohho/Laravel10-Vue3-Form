<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from 'vue-router';
import api from "../../api";

const router = useRouter();
const route = useRoute();
const total_bonus = ref("");
const employee1 = ref("");
const percentage1 = ref("");
const employee2 = ref("");
const percentage2 = ref("");
const employee3 = ref("");
const percentage3 = ref("");
const errors = ref([]);

onMounted(async () => {
    await api.get(`/api/bonus/${route.params.id}`)
        .then(response => {
            total_bonus.value = response.data.data.total_bonus;
            employee1.value = response.data.data.employee1;
            employee2.value = response.data.data.employee2;
            employee3.value = response.data.data.employee3;
        });
});

const updateBonus = async () => {
    let formData = new FormData();
    formData.append("total_bonus", total_bonus.value);
    formData.append("employee1", employee1.value);
    formData.append("percentage1", percentage1.value);
    formData.append("employee2", employee2.value);
    formData.append("percentage2", percentage2.value);
    formData.append("employee3", employee3.value);
    formData.append("percentage3", percentage3.value);
    formData.append("_method", "PATCH");

    try {
        await api.post(`/api/bonus/${route.params.id}`, formData);
        router.push({ path: "/" });
    } catch (error) {
        errors.value = error.response.data.errors;

        // Check if errors.value is an object
        if (typeof errors.value === 'object') {
            // Iterate over each error field and show its messages
            Object.values(errors.value).forEach(errorMessages => {
                if (Array.isArray(errorMessages)) {
                    errorMessages.forEach(errorMessage => {
                        window.alert(errorMessage);
                    });
                }
            });
        } else {
            window.alert('Nilai persentase tidak sama dengan 100%.');
        }
    }
};
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <form @submit.prevent="updateBonus()">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Pembayaran Bonus (Rupiah):</label>
                                <input type="text" class="form-control" v-model="total_bonus" placeholder="Nominal..">
                                <div v-if="errors.total_bonus" class="alert alert-danger mt-2">
                                    <span>{{ errors.total_bonus[0] }}</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Buruh A</label>
                                <input type="text" class="form-control" v-model="employee1" placeholder="Nama..">
                                <div v-if="errors.employee1" class="alert alert-danger mt-2">
                                    <span>Kolom ini tidak boleh kosong.</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Bonus</label>
                                <input class="form-control" rows="5" v-model="percentage1"
                                    placeholder="presentasi Bonus 1 - 100%">
                                <div v-if="errors.percentage1" class="alert alert-danger mt-2">
                                    <span>Kolom ini tidak boleh kosong.</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Buruh B</label>
                                <input type="text" class="form-control" v-model="employee2" placeholder="Nama..">
                                <div v-if="errors.employee2" class="alert alert-danger mt-2">
                                    <span>Kolom ini tidak boleh kosong.</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Bonus</label>
                                <input class="form-control" rows="5" v-model="percentage2"
                                    placeholder="presentasi Bonus 1 - 100%">
                                <div v-if="errors.percentage2" class="alert alert-danger mt-2">
                                    <span>Kolom ini tidak boleh kosong.</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Buruh C</label>
                                <input type="text" class="form-control" v-model="employee3" placeholder="Nama..">
                                <div v-if="errors.employee3" class="alert alert-danger mt-2">
                                    <span>Kolom ini tidak boleh kosong.</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Bonus</label>
                                <input class="form-control" rows="5" v-model="percentage3"
                                    placeholder="presentasi Bonus 1 - 100%">
                                <div v-if="errors.percentage3" class="alert alert-danger mt-2">
                                    <span>Kolom ini tidak boleh kosong.</span>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-md btn-primary rounded-sm shadow border-0">Update</button>
                            <router-link :to="{ name: 'bonus.index' }"
                                class="btn btn-md btn-primary rounded-sm shadow border-0 mx-2">Back</router-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>