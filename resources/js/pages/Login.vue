<template>
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <form
            @submit.prevent="iniciarSesion"
            class="bg-white p-6 rounded shadow-md w-96"
        >
            <h2 class="text-xl font-bold mb-4">Iniciar sesión</h2>
            <input
                v-model="email"
                type="email"
                placeholder="Email"
                class="w-full mb-3 p-2 border rounded"
            />
            <input
                v-model="password"
                type="password"
                placeholder="Contraseña"
                class="w-full mb-3 p-2 border rounded"
            />
            <button
                type="submit"
                class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700"
            >
                Entrar
            </button>
            <p v-if="error" class="text-red-600 mt-2">{{ error }}</p>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../services/api";

const email = ref("");
const password = ref("");
const error = ref("");
const router = useRouter();

const iniciarSesion = async () => {
    try {
        const response = await api.post("/login", {
            email: email.value,
            password: password.value,
        });
        localStorage.setItem("token", response.data.token);
        router.push("/clientes");
    } catch (err) {
        error.value = err.response?.data?.mensaje || "Error al iniciar sesión";
    }
};
</script>
