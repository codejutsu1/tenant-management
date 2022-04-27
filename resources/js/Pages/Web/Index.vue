<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/App.vue';

defineProps({
   canLogin: Boolean,
   canRegister: Boolean  
});

</script>
<template>
     <AppLayout>
          <Head title="Home" />
          
          <header class="md:h-screen md:py-0 py-32 bg-hero bg-cover bg-no-repeat bg-center">
               <div class="w-5/6 mx-auto flex justify-between">
                    <div class="flex items-center">
                         <h1 class="font-semibold text-xl tracking-wide">
                              <Link :href="route('home')">
                                   Lodge
                              </Link>
                         </h1>
                    </div>
               
                    <nav class="flex">
                         <ul class="flex items-center">
                              <Link :href="route('home')" class="px-6 py-4">
                                   Home
                              </Link>
                              <Link :href="route('about')" class="px-6 py-4">
                                   About Us
                              </Link>
                              <Link :href="route('contact')" class="px-6 py-4">
                                   Contact Us
                              </Link>
                         </ul>
                         <div v-if="canLogin" class="hidden px-6 py-4 sm:block">
                              <Link v-if="$page.props.auth.user" :href="route('dashboard')">
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

               <div class="w-5/6 mx-auto pt-44 h-full">
                    <div class="w-2/5 p-4">
                         <h1 class="text-5xl font-semibold">
                              A place you can call home anytime. 
                         </h1>
                         <p class="text-xl my-6 font-semibold">
                              A suitable place for your stay.
                         </p>
                         <a href="#" class="text-center font-semibold px-6 py-4 border-2 rounded-md w-full inline-block">
                              Choose your room
                         </a>
                    </div>
               </div>
          </header>

          <main>
               <!-- About Us  -->
               <section>
                    <div class="py-12">
                         <h1 class="text-center text-4xl font-semibold">
                              About Us
                         </h1>
                         <div class="flex justify-center">
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
                         <div class="flex"> 
                              <div class="w-2/5">
                                   <img src="/images/about.jpg" alt="About us image">
                              </div>
                              <div class="w-1/2 pt-32 text-lg font-semibold text-gray-900">
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
                              <div class="flex pt-24 justify-between">
                                   <div class="w-2/5">
                                        <img src="/images/girl.svg" alt="">
                                   </div>
                                   <div class="w-3/5 px-10">
                                        <h1 class="text-center text-3xl font-semibold my-5">Conducive Environment</h1>
                                        <p class="text-lg font-semibold text-gray-900">
                                             Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                             Tempora fuga quia error, ex hic inventore in delectus, at possimus culpa fugit neque necessitatibus, 
                                             nemo eius quasi! Nulla numquam accusantium eos.

                                             Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, neque porro eius asperiores atque magnam assumenda
                                             ducimus delectus dolorem blanditiis explicabo at debitis placeat velit mollitia? Quaerat facilis perferendis voluptatum.
                                        </p>

                                        <a href="#" class="text-center text-lg font-semibold px-6 py-4 my-5 border-2 rounded-md w-full inline-block">
                                             Choose a room
                                        </a>          
                                   </div>
                              </div>
                              <div class="flex pt-24 justify-between">
                                   <div class="w-3/5 pr-10">
                                        <h1 class="text-center text-3xl font-semibold my-5">Safe Environment</h1>
                                        <p class="text-lg font-semibold text-gray-900">
                                             Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                             Tempora fuga quia error, ex hic inventore in delectus, at possimus culpa fugit neque necessitatibus, 
                                             nemo eius quasi! Nulla numquam accusantium eos.

                                             Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, neque porro eius asperiores atque magnam assumenda
                                             ducimus delectus dolorem blanditiis explicabo at debitis placeat velit mollitia? Quaerat facilis perferendis voluptatum.
                                        </p>

                                        <a href="#" class="text-center text-lg font-semibold px-6 py-4 my-5 border-2 rounded-md w-full inline-block">
                                             Choose a room
                                        </a>          
                                   </div>
                                   <div class="w-2/5">
                                        <img src="/images/window.svg" alt="">
                                   </div>
                              </div>
                              <div class="flex pt-24 justify-between">
                                   <div class="w-2/5">
                                        <img src="/images/boy.jpg" alt="">
                                   </div>
                                   <div class="w-3/5 px-10">
                                        <h1 class="text-center text-3xl font-semibold my-5">Comfortable Viewport</h1>
                                        <p class="text-lg font-semibold text-gray-900">
                                             Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                             Tempora fuga quia error, ex hic inventore in delectus, at possimus culpa fugit neque necessitatibus, 
                                             nemo eius quasi! Nulla numquam accusantium eos.

                                             Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, neque porro eius asperiores atque magnam assumenda
                                             ducimus delectus dolorem blanditiis explicabo at debitis placeat velit mollitia? Quaerat facilis perferendis voluptatum.
                                        </p>

                                        <a href="#" class="text-center text-lg font-semibold px-6 py-4 my-5 border-2 rounded-md w-full inline-block">
                                             Choose a room
                                        </a>          
                                   </div>
                              </div>
                         </div>
                    </div>
               </section>

               <!-- Our Services -->
               <section>
                    <div class="py-12">
                         <h1 class="text-center text-4xl font-semibold">
                              Our Services
                         </h1>
                         <div class="flex justify-center">
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
                              <div class="grid grid-cols-4 gap-5 w-5/6 mx-auto">
                                   <div class="border-2 py-10 px-4 rounded-md">
                                        <h1 class="text-center font-semibold text-2xl mb-5">24/7 Power Supply</h1>
                                        <p class="font-semibold text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
                                             dicta quisquam sed nulla ipsum consectetur minima recusandae. Corporis ad laborum sed porro.
                                        </p>
                                   </div>
                                   <div class="border-2 py-10 px-4 rounded-md">
                                        <h1 class="text-center font-semibold text-2xl mb-5">24/7 Water Supply</h1>
                                        <p class="font-semibold text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
                                             dicta quisquam sed nulla ipsum consectetur minima recusandae. Corporis ad laborum sed porro.
                                        </p>
                                   </div>
                                   <div class="border-2 py-10 px-4 rounded-md">
                                        <h1 class="text-center font-semibold text-2xl mb-5">Good Security</h1>
                                        <p class="font-semibold text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
                                             dicta quisquam sed nulla ipsum consectetur minima recusandae. Corporis ad laborum sed porro.
                                        </p>
                                   </div>
                                   <div class="border-2 py-10 px-4 rounded-md">
                                        <h1 class="text-center font-semibold text-2xl mb-5">Constant Maintenance</h1>
                                        <p class="font-semibold text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
                                             dicta quisquam sed nulla ipsum consectetur minima recusandae. Corporis ad laborum sed porro.
                                        </p>
                                   </div>
                              </div>
                         </div>
                    </div>
               </section>

               <!-- Testimonials -->
               <section>
                    <div>
                         <h1 class="text-center text-4xl font-semibold">
                              Testimonials
                         </h1>
                         <div class="flex justify-center">
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
                         <div class="border-2 w-3/5 mx-auto py-5 px-2 rounded-md">
                              <div class="border-4 bg-gray-600 rounded-full mx-auto mb-5" style="width: 100px; height: 100px;">

                              </div>
                              <div class="pb-12">
                                   <h2 class="font-semibold text-lg text-center my-3">Adam Williams</h2>
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
               <section>
                    <div class="py-12">
                         <div class="w-1/2 mx-auto py-8 px-4">
                              <h1 class="font-semibold text-4xl text-center">The best situable place for your stay.</h1>
                              <p class="font-semibold my-5 text-center text-2xl">Hurry now and choose a room</p>
                              <a href="#" class="text-center text-lg font-semibold px-6 py-4 my-5 border-2 rounded-md w-1/2 block mx-auto">
                                   Choose a room
                              </a>      
                         </div>
                    </div>
               </section>

               <!-- Footer -->
               <footer>
                    <div class="w-5/6 mx-auto py-12 flex justify-between border-b-2">
                         <div class="w-1/3">
                              <h1>Lodge Name</h1>
                         </div>
                         <div class="w-1/3">
                              <ul class="text-center">
                                   <li>Home</li>
                                   <li>About Us</li>
                                   <li>Contact Us</li>
                                   <li>Terms and Condition</li>
                                   <li>Privacy Policy</li>
                              </ul>
                         </div>
                         <div class="w-1/3">
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