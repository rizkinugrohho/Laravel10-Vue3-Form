<template>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h2>Detail Bonus</h2>
                        <h3>Pembayaran : Rp. {{ bonus.total_bonus }}</h3>
                        <div v-if="loading">Loading...</div>
                        <div v-else>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama Karyawan</th>
                                        <th class="text-center">Presentasi Bonus</th>
                                        <th class="text-center">Total Bonus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ bonus.employee1 }}</td>
                                        <td class="text-center">{{ (bonus.percentage1 * 100).toFixed(2) }}%</td>
                                        <td class="text-center">Rp. {{ bonus.bonus1 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ bonus.employee2 }}</td>
                                        <td class="text-center">{{ (bonus.percentage2 * 100).toFixed(2) }}%</td>
                                        <td class="text-center">Rp. {{ bonus.bonus2 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">{{ bonus.employee3 }}</td>
                                        <td class="text-center">{{ (bonus.percentage3 * 100).toFixed(2) }}%</td>
                                        <td class="text-center">Rp. {{ bonus.bonus3 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><strong>Total Presentasi :</strong></td>
                                        <td class="text-center"><strong>{{ calculateTotalBonus(bonus) }}</strong></td>
                                        <td class="text-center"><strong>{{ calculateTotalBonus2(bonus) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <router-link :to="{ name: 'bonus.index' }"
                                class="btn btn-md btn-primary rounded-sm shadow border-0">Back</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';
import { useRoute } from 'vue-router';

const route = useRoute();
const bonus = ref({});
const loading = ref(true);

onMounted(async () => {
    try {
        const response = await api.get(`/api/bonus/${route.params.id}`);
        bonus.value = response.data.data;
        console.log('Bonus 1:', bonus.value.bonus1);
        loading.value = false;
    } catch (error) {
        console.error(error);
        loading.value = false;
    }
});

const calculateTotalBonus = (bonus) => {
    const percentage1 = parseFloat(bonus.percentage1);
    const percentage2 = parseFloat(bonus.percentage2);
    const percentage3 = parseFloat(bonus.percentage3);

    if (isNaN(percentage1) || isNaN(percentage2) || isNaN(percentage3)) {
        return "Invalid percentages";
    }

    const total = (percentage1 + percentage2 + percentage3) * 100;
    return total.toFixed(2) + "%";
};

const calculateTotalBonus2 = (bonus) => {
    const bonus1 = parseFloat(bonus.bonus1);
    const bonus2 = parseFloat(bonus.bonus2);
    const bonus3 = parseFloat(bonus.bonus3);

    if (isNaN(bonus1) || isNaN(bonus2) || isNaN(bonus3)) {
        return "Invalid percentages";
    }

    const total = (bonus1 + bonus2 + bonus3);
    return "Rp. " + total;
};
</script>