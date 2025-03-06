<script setup>
import { reactive, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    usuario: {
        type: Object,
        default: () => ({ nombre: '', apellido: '', email: '', estado: 'A', password: '' }) // Datos vacíos si es creación
    }
});

// Formulario reactivo
const form = useForm({
    nombre: props.usuario.nombre,
    apellido: props.usuario.apellido,
    email: props.usuario.email,
    estado: props.usuario.estado,
    password: '' // La contraseña no se precarga por seguridad
});

// Determinar si es "Crear" o "Editar"
const esEdicion = computed(() => !!props.usuario.id);

// Método para guardar
const guardarUsuario = () => {
    if (esEdicion.value) {
        form.put(route('userUpdate', props.usuario.id)); // Ruta para actualizar
    } else {
        form.post(route('userStore')); // Ruta para crear
    }
};
</script>

<template>
    <Head :title="esEdicion ? 'Editar Usuario' : 'Crear Usuario'" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-2xl font-bold text-gray-700 mb-4">
                    {{ esEdicion ? 'Editar Usuario' : 'Crear Usuario' }}
                </h1>

                <form @submit.prevent="guardarUsuario">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input v-model="form.nombre" type="text" class="w-full p-2 border rounded" required />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Apellido</label>
                        <input v-model="form.apellido" type="text" class="w-full p-2 border rounded" required />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input v-model="form.email" type="email" class="w-full p-2 border rounded" required :disabled="esEdicion" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input v-model="form.password" type="password" class="w-full p-2 border rounded" :required="!esEdicion" />
                        <p v-if="esEdicion" class="text-sm text-gray-500">Dejar en blanco para no cambiar la contraseña.</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Estado</label>
                        <select v-model="form.estado" class="w-full p-2 border rounded">
                            <option value="A">Activo</option>
                            <option value="I">Inactivo</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button onclick="history.back()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-gray-700">
                            ← Regresar
                        </button>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            {{ esEdicion ? 'Actualizar' : 'Crear' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
