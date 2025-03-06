<script setup>
import { ref } from 'vue';
import Swal from 'sweetalert2';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Eye, Pencil, UserX, UserCheck } from "lucide-vue-next";

defineProps({
    usuarios: Array
});



const usuarioSeleccionado = ref({});
const modalVisible = ref(false);

const verUsuario = (usuario) => {
    usuarioSeleccionado.value = usuario;
    modalVisible.value = true; // Abre el modal
};

const cerrarModal = () => {
    modalVisible.value = false; // Cierra el modal
};

const estadoUsuario = (id) => {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡El estado del usuario cambiará!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, cambiar estado",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route('userStatus', id), {}, { preserveScroll: true });
            Swal.fire("¡Cambiado!", "El estado del usuario ha sido actualizado.", "success");
        }
    });
};
</script>
<template>
    <Head title="Usuarios" />

    <AuthenticatedLayout>
        <template #header>
            <h6 class="text-2xl font-bold text-gray-800">
                Lista de Usuarios
            </h6>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="mb-6">
                        <h1 class="text-4xl font-semibold text-center text-gray-700">
                            Usuarios
                        </h1>
                    </div>
                    <div class="flex justify-end mb-4">
                        <Link :href="route('userCreate')" class="px-4 py-2 bg-green-600 text-white rounded">
                            + Nuevo Usuario
                        </Link>
                    </div>
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Nombre</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2">Estado</th>
                            <th class="text-center border border-gray-300 px-4 py-2">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="usuario in usuarios" :key="usuario.id">
                            <td class="border border-gray-300 px-4 py-2">{{ usuario.id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ usuario.nombre }} {{ usuario.apellido }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ usuario.email }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <span :class="usuario.estado === 'A' ? 'text-green-600' : 'text-red-600'">
                                    {{ usuario.estado === 'A' ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-center border border-gray-300 px-4 py-2">
                                <div class="flex justify-center items-center space-x-4">
                                    <button class="text-blue-500 hover:text-blue-700" @click="verUsuario(usuario)">
                                        <Eye class="w-5 h-5" title="Ver usuario" />
                                    </button>

                                    <Link :href="route('userEdit', usuario.id)" class="text-yellow-500 hover:text-yellow-700" title="Editar usuario">
                                        <Pencil class="w-5 h-5" />
                                    </Link>

                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" :checked="usuario.estado === 'A'" @change="estadoUsuario(usuario.id)" />
                                        <div class="w-11 h-6 bg-gray-300 peer-focus:ring-4 rounded-full peer peer-checked:after:translate-x-full
                 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px]
                 after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5
                 after:transition-all peer-checked:bg-green-500">
                                        </div>
                                    </label>
                                </div>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                    <p v-if="usuarios.length === 0" class="mt-4 text-gray-600 text-center">
                        No hay usuarios registrados.
                    </p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <!-- MODAL -->
    <div v-if="modalVisible" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h5 class="text-lg font-bold mb-4">Detalles del Usuario</h5>
            <p><strong>ID:</strong> {{ usuarioSeleccionado.id }}</p>
            <p><strong>Nombre:</strong> {{ usuarioSeleccionado.nombre }} {{ usuarioSeleccionado.apellido }}</p>
            <p><strong>Email:</strong> {{ usuarioSeleccionado.email }}</p>
            <p><strong>Estado:</strong>
                <span :class="usuarioSeleccionado.estado === 'A' ? 'text-green-600' : 'text-red-600'">
                {{ usuarioSeleccionado.estado === 'A' ? 'Activo' : 'Inactivo' }}
            </span>
            </p>
            <div class="mt-4 flex justify-end">
                <button @click="cerrarModal" class="px-4 py-2 bg-gray-500 text-white rounded">Cerrar</button>
            </div>
        </div>
    </div>
</template>
