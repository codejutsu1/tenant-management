<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/App.vue';
import { ref } from 'vue';

defineProps({
   canLogin: Boolean,
   canRegister: Boolean  
});

const navbarOpen = ref(false)

</script>
<template>
     <AppLayout>
          <Head title="Home" />
          
          <header class="md:h-screen md:py-0 py-10 bg-hero bg-cover bg-no-repeat bg-center">
               <div class="w-5/6 mx-auto flex justify-between">
                    <div class="flex items-center">
                         <h1 class="tracking-wide text-yellow-400 font-bold text-2xl">
                              <Link :href="route('home')">
                                   Lodge
                              </Link>
                         </h1>
                    </div>
               
                    <nav class="flex">
                         <div class="md:hidden flex justify-end items-center pt-2 z-[60] relative">
                              <button type="button" @click="navbarOpen =! navbarOpen" class="p-1 -ml-1 text-yellow-400 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple transition duration-150 ease-in-out">
                                   <svg class="h-6 w-6" stroke="currentColor" fill="currentColor" viewBox="0 0 20 20">
                                        <path :class="{'hidden': navbarOpen, 'inline-flex': !navbarOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{'hidden': ! navbarOpen, 'inline-flex': navbarOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                   </svg>
                              </button>
                         </div>    
                         <ul class="md:flex items-center hidden">
                              <Link :href="route('home')" class="px-6 py-4">
                                   Home
                              </Link>
                              <a href="#about" class="px-6 py-4">
                                   About Us
                              </a>
                              <Link :href="route('contact')" class="px-6 py-4">
                                   Contact Us
                              </Link>
                         </ul>
                         <div v-if="canLogin" class="hidden px-6 py-4 sm:block">
                              <Link v-if="$page.props.auth.user" :href="route('dashboard.user')">
                                   Dashboard
                              </Link>

                              <template v-else>
                                   <Link :href="route('login')">
                                        Log in
                                   </Link>

                                   <Link v-if="canRegister" :href="route('register')" class="px-6 py-4">
                                        Register
                                   </Link>
                              </template>
                         </div>
                    </nav>
               </div>

               <div class="md:w-5/6 mx-auto w-11/12 pt-20 md:pt-44 h-full">
                    <div class="md:w-2/5 w-full p-4">
                         <h1 class="text-5xl font-semibold">
                              A place you can call home anytime. 
                         </h1>
                         <p class="text-xl my-6 text-center md:text-left font-semibold">
                              A suitable place for your stay.
                         </p>
                         <a href="#" class="text-center font-semibold px-6 py-4 rounded-md w-full inline-block bg-black text-yellow-400 hover:shadow-xl">
                              Choose your room
                         </a>
                    </div>
               </div>

               <!-- Responsive -->
               <div class="w-full h-full z-40 inset-0 fixed bg-black opacity-60" @click="navbarOpen = false" :class="{'hidden': !navbarOpen, 'block': navbarOpen}"></div>
               <div :class="{'hidden': !navbarOpen, 'block': navbarOpen}">
                <ul class="bg-white fixed top-16 z-50 w-full text-center space-y-10 py-10 rounded-md text-yellow-600">
                    <li>
                        <a href="/" class="font-semibold">
                            HOME
                        </a>
                    </li>
                    <li>
                        <a href="#about" class="font-semibold">
                            ABOUT
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="font-semibold">
                            CONTACT US
                        </a>
                    </li>
                    <li>
                         <div v-if="$page.props.canLogin" class="px-6 py-4 text-lg font-semibold sm:block">
                              <Link v-if="$page.props.auth.user" :href="route('dashboard.user')">
                                   Dashboard
                              </Link>

                              <template v-else>
                                   <Link :href="route('login')">
                                   Log in
                                   </Link>
                                   <span class="px-3">|</span>
                                   <Link v-if="$page.props.canRegister" :href="route('register')" class="py-4">
                                   Register
                                   </Link>
                              </template>
                         </div>
                    </li>
                </ul>
            </div>
          </header>

          <main>
               <!-- About Us  -->
               <section id="about">
                    <div class="py-12">
                         <h1 class="text-center text-4xl font-semibold">
                              About Us
                         </h1>
                         <div class="flex justify-center text-yellow-500">
                              <div class="flex items-center"> 
                                   <span class="border-solid border-2 inline-block line border-black"></span>
                              </div>
                              <h2 class="text-center text-3xl font-semibold my-5 mx-5">
                                   Our Story
                              </h2>
                              <div class="flex items-center"> 
                                   <span class="border-solid border-2 inline-block line border-black"></span>
                              </div>
                         </div>
                         <div class="md:flex"> 
                              <div class="md:w-2/5 w-11/12 mx-auto">
                                   <img src="/images/about.jpg" alt="About us image">
                              </div>
                              <div class="md:w-1/2 w-11/12 mx-auto md:mx-0 pt-10 md:pt-32 text-lg font-semibold text-gray-900">
                                   <p>Lorem ipsm dolor sit amet consectetur adipisicing elit. Accusamus saepe non commodi assumenda architecto,
                                   tempora sequi explicabo, aperiam dignissimos eius excepturi laboriosam voluptatem 
                                   ex! Tempora provident exercitationem molestiae repudiandae ducimus?

                                   Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem tempore, 
                                   quae reprehenderit placeat rem omnis saepe eius excepturi nam, ipsam at veritatis amet
                                    doloribus laboriosam aut iusto facilis. Sequi, fuga.

                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus alias dicta 
                                    mollitia voluptate iste veniam cumque nisi et consequatur quidem, a, 
                                    illum, nihil recusandae culpa repudiandae magnam asperiores? Omnis, quaerat?
                                   </p>
                              </div>
                         </div>
                    </div>
               </section>

               <!-- Why Us -->
               <section>
                    <div class="py-12">
                         <h1 class="text-center text-4xl font-semibold">Why us?</h1>
                         <div class="pt-22 mx-auto w-5/6">
                              <div class="md:flex pt-24 justify-between">
                                   <div class="md:w-2/5 w-11/12 mx-auto">
                                        <img src="/images/girl.svg" alt="">
                                   </div>
                                   <div class="md:w-3/5 w-full md:px-10">
                                        <h1 class="text-center text-3xl font-semibold my-5">Conducive Environment</h1>
                                        <p class="text-lg font-semibold text-gray-900">
                                             Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                             Tempora fuga quia error, ex hic inventore in delectus, at possimus culpa fugit neque necessitatibus, 
                                             nemo eius quasi! Nulla numquam accusantium eos.

                                             Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, neque porro eius asperiores atque magnam assumenda
                                             ducimus delectus dolorem blanditiis explicabo at debitis placeat velit mollitia? Quaerat facilis perferendis voluptatum.
                                        </p>

                                        <a href="#" class="text-center text-lg font-semibold px-6 py-4 my-5 rounded-md w-full inline-block bg-black text-yellow-400 hover:shadow-xl">
                                             Choose a room
                                        </a>          
                                   </div>
                              </div>
                              <div class="md:flex pt-24 justify-between">
                                   <div class="md:hidden w-11/12 mx-auto">
                                        <img src="/images/window.svg" alt="">
                                   </div>
                                   <div class="md:w-3/5 w-full md:px-0 mx-auto md:pr-10">
                                        <h1 class="text-center text-3xl font-semibold my-5">Safe Environment</h1>
                                        <p class="text-lg font-semibold text-gray-900">
                                             Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                             Tempora fuga quia error, ex hic inventore in delectus, at possimus culpa fugit neque necessitatibus, 
                                             nemo eius quasi! Nulla numquam accusantium eos.

                                             Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, neque porro eius asperiores atque magnam assumenda
                                             ducimus delectus dolorem blanditiis explicabo at debitis placeat velit mollitia? Quaerat facilis perferendis voluptatum.
                                        </p>

                                        <a href="#" class="text-center text-lg font-semibold px-6 py-4 my-5 rounded-md w-full inline-block bg-black text-yellow-400 hover:shadow-xl">
                                             Choose a room
                                        </a>          
                                   </div>
                                   <div class="w-2/5 hidden md:block">
                                        <img src="/images/window.svg" alt="">
                                   </div>
                              </div>
                              <div class="md:flex pt-24 justify-between">
                                   <div class="md:w-2/5 w-11/12 mx-auto">
                                        <img src="/images/boy.jpg" alt="">
                                   </div>
                                   <div class="md:w-3/5 w-full md:px-10">
                                        <h1 class="text-center text-3xl font-semibold my-5">Comfortable Viewport</h1>
                                        <p class="text-lg font-semibold text-gray-900">
                                             Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                             Tempora fuga quia error, ex hic inventore in delectus, at possimus culpa fugit neque necessitatibus, 
                                             nemo eius quasi! Nulla numquam accusantium eos.

                                             Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, neque porro eius asperiores atque magnam assumenda
                                             ducimus delectus dolorem blanditiis explicabo at debitis placeat velit mollitia? Quaerat facilis perferendis voluptatum.
                                        </p>

                                        <a href="#" class="text-center text-lg font-semibold px-6 py-4 my-5 rounded-md w-full inline-block bg-black text-yellow-400 hover:shadow-xl">
                                             Choose a room
                                        </a>          
                                   </div>
                              </div>
                         </div>
                    </div>
               </section>

               <!-- Our Services -->
               <section>
                    <div class="py-12 w-11/12 mx-auto md:mx-0 md:w-full">
                         <h1 class="text-center text-4xl font-semibold">
                              Our Services
                         </h1>
                         <div class="flex justify-center text-yellow-500">
                              <div class="flex items-center"> 
                                   <span class="border-solid border-2 inline-block line border-black"></span>
                              </div>
                              <h2 class="text-center text-3xl font-semibold my-5 mx-5">
                                   Range of Services to enjoy
                              </h2>
                              <div class="flex items-center"> 
                                   <span class="border-solid border-2 inline-block line border-black"></span>
                              </div>
                         </div>
                         <div class="py-8">
                              <div class="md:grid grid-cols-4 gap-5 space-y-16 md:space-y-0 w-5/6 mx-auto text-gray-200">
                                   <div class="py-10 px-4 rounded-md shadow-2xl bg-zinc-800">
                                        <h1 class="text-center font-semibold text-xl mb-5 text-yellow-400">24/7 Power Supply</h1>
                                        <p class="font-semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
                                             dicta quisquam sed nulla ipsum consectetur minima recusandae. Corporis ad laborum sed porro.
                                        </p>
                                   </div>
                                   <div class="py-10 px-4 rounded-md shadow-xl bg-zinc-800">
                                        <h1 class="text-center font-semibold text-2xl mb-5 text-yellow-400">24/7 Water Supply</h1>
                                        <p class="font-semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
                                             dicta quisquam sed nulla ipsum consectetur minima recusandae. Corporis ad laborum sed porro.
                                        </p>
                                   </div>
                                   <div class="py-10 px-4 rounded-md shadow-xl bg-zinc-800">
                                        <h1 class="text-center font-semibold text-2xl mb-5 text-yellow-400">Good Security</h1>
                                        <p class="font-semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
                                             dicta quisquam sed nulla ipsum consectetur minima recusandae. Corporis ad laborum sed porro.
                                        </p>
                                   </div>
                                   <div class="py-10 px-4 rounded-md shadow-xl bg-zinc-800">
                                        <h1 class="text-center font-semibold text-2xl mb-5 text-yellow-400">Constant Maintenance</h1>
                                        <p class="font-semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
                                             dicta quisquam sed nulla ipsum consectetur minima recusandae. Corporis ad laborum sed porro.
                                        </p>
                                   </div>
                              </div>
                         </div>
                    </div>
               </section>

               <!-- Testimonials -->
               <section>
                    <div class="w-11/12 mx-auto md:mx-0 md:w-full">
                         <h1 class="text-center text-4xl font-semibold">
                              Testimonials
                         </h1>
                         <div class="flex justify-center text-yellow-500">
                              <div class="flex items-center"> 
                                   <span class="border-solid border-2 inline-block line border-black"></span>
                              </div>
                              <h2 class="text-center text-3xl font-semibold my-5 mx-5">
                                   See what people say about us
                              </h2>
                              <div class="flex items-center"> 
                                   <span class="border-solid border-2 inline-block line border-black"></span>
                              </div>
                         </div>
                    </div>

                    <div class="py-8 px-3">
                         <div class="md:w-3/5 w-full mx-auto py-5 px-2 rounded-md shadow-xl bg-zinc-800">
                              <div class="border-4 border-l-yellow-400 border-r-yellow-400 bg-gray-600 rounded-full mx-auto mb-5" style="width: 100px; height: 100px;">

                              </div>
                              <div class="pb-12 text-gray-200">
                                   <h2 class="font-semibold text-lg text-center my-3 text-yellow-400">Adam Williams</h2>
                                   <p>
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex explicabo dolorem laborum nesciunt 
                                        accusamus provident excepturi, molestias libero quibusdam labore hic quidem ratione laboriosam 
                                        nostrum nisi error voluptatibus vero ut? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae, corporis itaque iste corrupti 
                                   </p>
                              </div>
                         </div>
                    </div>
               </section>

               <!-- CTA -->
               <section class="bg-general-hero bg-cover bg-no-repeat bg-center relative">
                    <div class="bg-yellow-600 absolute inset-0 opacity-80 z-30"></div>
                    <div class="py-12 relative z-40">
                         <div class="md:w-1/2 w-full mx-auto py-8 px-4">
                              <h1 class="font-bold text-4xl text-center text-black">The best situable place for your stay.</h1>
                              <p class="font-bold my-5 text-center text-2xl text-black">Hurry now and choose a room</p>
                              <a :href="route('register')" class="text-center text-lg font-semibold px-6 py-4 my-5 hover:shadow-xl rounded-md w-1/2 block mx-auto bg-black text-yellow-400">
                                   Choose a room
                              </a>      
                         </div>
                    </div>
               </section>

               <!-- Footer -->
               <footer class="bg-zinc-800 text-gray-200">
                    <div class="w-5/6 mx-auto py-12 md:flex space-y-5 md:space-y-0 justify-between border-b-2">
                         <div class="md:w-1/3 w-full">
                              <h1 class="font-bold text-2xl text-yellow-400 text-center md:text-left">Lodge Name</h1>
                         </div>
                         <div class="md:w-1/3 w-full">
                              <ul class="text-center space-y-6">
                                   <li>Home</li>
                                   <li>About Us</li>
                                   <li>Contact Us</li>
                                   <li>Terms and Condition</li>
                                   <li>Privacy Policy</li>
                              </ul>
                         </div>
                         <div class="md:w-1/3 w-full">
                              <ul class="text-center">
                                   <li>Facebook</li>
                                   <li>Whatsapp</li>
                                   <li>Twitter</li>
                                   <li>Instagram</li>
                              </ul>
                         </div>
                    </div>
                    <div class="text-center font-semibold py-8">
                         <p>Copyright &copy; 2022 Lodge</p>
                    </div>
               </footer>
          </main>
     </AppLayout>
     
</template>