<template>
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-4">Clientes</h1>

        <!-- Lista -->
        <table class="w-full border text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Nombre</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">NIT</th>
                    <th class="p-2">Teléfono</th>
                    <th class="p-2">Dirección</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cliente in clientes" :key="cliente.id">
                    <td class="p-2">{{ cliente.nombre }}</td>
                    <td class="p-2">{{ cliente.email }}</td>
                    <td class="p-2">{{ cliente.NIT }}</td>
                    <td class="p-2">{{ cliente.teléfono }}</td>
                    <td class="p-2">{{ cliente.dirección }}</td>
                    <td class="p-2">
                        <button
                            @click="editar(cliente)"
                            class="text-blue-600 mr-2"
                        >
                            Editar
                        </button>
                        <button
                            @click="eliminar(cliente.id)"
                            class="text-red-600"
                        >
                            Eliminar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Botón -->
        <button
            @click="nuevo"
            class="mt-4 bg-green-600 text-white px-4 py-2 rounded"
        >
            Nuevo Cliente
        </button>

        <!-- Modal simple -->
        <div v-if="modal" class="mt-6 border-t pt-4">
            <h2 class="text-xl font-bold mb-2">
                {{ cliente.id ? "Editar" : "Nuevo" }} Cliente
            </h2>
            <form @submit.prevent="guardar">
                <input
                    v-model="cliente.nombre"
                    placeholder="Nombre"
                    class="w-full mb-2 p-2 border rounded"
                    required
                />
                <input
                    v-model="cliente.email"
                    placeholder="Email"
                    class="w-full mb-2 p-2 border rounded"
                    required
                />
                <input
                    v-model="cliente.NIT"
                    placeholder="NIT"
                    class="w-full mb-2 p-2 border rounded"
                    required
                />
                <input
                    v-model="cliente.teléfono"
                    placeholder="Teléfono"
                    class="w-full mb-2 p-2 border rounded"
                />
                <textarea
                    v-model="cliente.dirección"
                    placeholder="Dirección"
                    class="w-full mb-2 p-2 border rounded"
                ></textarea>
                <button
                    class="bg-blue-600 text-white px-4 py-2 rounded"
                    type="submit"
                >
                    Guardar
                </button>
                <button @click="modal = false" class="ml-2 text-gray-600">
                    Cancelar
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../services/api";

const clientes = ref([]);
const cliente = ref({});
const modal = ref(false);

const cargarClientes = async () => {
    const { data } = await api.get("/clientes");
    clientes.value = data;
};

const nuevo = () => {
    cliente.value = {};
    modal.value = true;
};

const editar = (c) => {
    cliente.value = { ...c };
    modal.value = true;
};

const guardar = async () => {
    if (cliente.value.id) {
        await api.put(`/clientes/${cliente.value.id}`, cliente.value);
    } else {
        await api.post("/clientes", cliente.value);
    }
    modal.value = false;
    await cargarClientes();
};

const eliminar = async (id) => {
    if (confirm("¿Estás seguro de eliminar este cliente?")) {
        await api.delete(`/clientes/${id}`);
        await cargarClientes();
    }
};

onMounted(cargarClientes);
</script>
