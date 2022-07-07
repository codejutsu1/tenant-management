<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Register" />

        <BreezeValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="name" value="Fullname" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
            </div>
    
            <div class="mt-4">
                <BreezeLabel for="phone" value="Telephone" />
                <BreezeInput id="phone" type="tel" class="mt-1 block w-full"  required />
            </div>

            <div class="mt-4">
                <BreezeLabel for="gender" value="Gender" />
                <select id="gender" type="text" class="mt-1 block w-full"  required>
                    <option value="" selected="selected" disabled>~ Select ~</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="mt-4">
                <BreezeLabel for="dob" value="Date of Birth" />
                <BreezeInput id="dob" type="date" class="mt-1 block w-full" required />
            </div>

            <div class="mt-4">
                <BreezeLabel for="type" value="Type" />
                <select id="type" type="text" class="mt-1 block w-full"  required>
                    <option value="" selected="selected" disabled>~ Select ~</option>
                    <option value="self-con">Self Container</option>
                    <option value="two-rooms">Two Rooms</option>
                    <option value="three-rooms">Three Rooms</option>
                    <option value="shop">Shop</option>
                </select>
            </div>

            <div class="mt-4">
                <BreezeLabel for="state" value="State of Origin" />
                <select id="state" type="text" class="mt-1 block w-full"  required>
                    <option value="" selected="selected" disabled>~ Select ~</option>
                    <option value="Abia">Abia</option>
                    <option value="Anambra">Anambra</option>
                    <option value="Ebonyi">Ebonyi</option>
                    <option value="Enugu">Enugu</option>
                    <option value="Imo">Imo</option>
                </select>
            </div>

            <div class="mt-4">
                <BreezeLabel for="lga" value="Local Government Area" />
                <select id="lga" type="text" class="mt-1 block w-full"  required>
                    <option value="" selected="selected" disabled>~ Select ~</option>
                    <option value="Aniri">Aniri</option>
                    <option value="Awgu">Awgu</option>
                    <option value="Owerri-west">Owerri-West</option>
                    <option value="Idemili-North">Idemili-North</option>
                    <option value="Mbaise">Mbaise</option>
                </select>
            </div>

            <div class="mt-4">
                <BreezeLabel for="occupation" value="Occupation" />
                <select id="occupation" type="text" class="mt-1 block w-full"  required>
                    <option value="" selected="selected" disabled>~ Select ~</option>
                    <option value="civil servant">Civil Servant</option>
                    <option value="businessman">Businessman</option>
                    <option value="freelancer">Freelancer</option>
                    <option value="enterpreneur">Enterpreneur</option>
                    <option value="student">Student</option>
                </select>
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Confirm Password" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>
