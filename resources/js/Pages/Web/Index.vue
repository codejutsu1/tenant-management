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
                              Logo
                         </h1>
                    </div>
               
                    <nav class="flex">
                         <ul class="flex items-center">
                              <li class="px-6 py-4">
                                   Home
                              </li>
                              <li class="px-6 py-4">
                                   About Us
                              </li>
                              <li class="px-6 py-4">
                                   Contact Us
                              </li>
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
                         <h1 class="text-center text-2xl font-semibold">
                              About Us
                         </h1>
                         <h2 class="text-center text-xl font-semibold my-5">
                              Our Story
                         </h2>
                         <div class="w-3/5 mx-auto">
                              <p>Lorem ipsm dolor sit amet consectetur adipisicing elit. Accusamus saepe non commodi assumenda architecto,
                              tempora sequi explicabo, aperiam dignissimos eius excepturi laboriosam voluptatem 
                              ex! Tempora provident exercitationem molestiae repudiandae ducimus?
                              </p>
                         </div>
                    </div>
               </section>

               <!-- Why Us -->
               <section>
                    <div class="py-12">
                         <h1 class="text-center text-2xl font-semibold">Why us?</h1>
                         <div>

                         </div>
                         <div>

                         </div>
                         <div>

                         </div>
                    </div>
               </section>

               <!-- Our Services -->
               <section>
                    <div>
                         <h1>Every wide range of Services to enjoy</h1>
                         <div>
                              <div>
                                   <div>
                                        <h1>Incredible</h1>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
                                             dicta quisquam sed nulla ipsum consectetur minima recusandae. Corporis ad laborum sed porro.
                                        </p>
                                   </div>
                                   <div>
                                        <h1>General</h1>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
                                             dicta quisquam sed nulla ipsum consectetur minima recusandae. Corporis ad laborum sed porro.
                                        </p>
                                   </div>
                                   <div>
                                        <h1>Awesome</h1>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
                                             dicta quisquam sed nulla ipsum consectetur minima recusandae. Corporis ad laborum sed porro.
                                        </p>
                                   </div>
                                   <div>
                                        <h1>Refined</h1>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit optio consequatur rerum deserunt, sequi voluptate ab s
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
                         <h1>See what people say about us</h1>
                         <div>
                              <div>

                              </div>
                         </div>
                    </div>
               </section>

               <!-- CTA -->
               <section>
                    <div>

                    </div>
               </section>

               <!-- Contact Us -->
               <section>
                    <div>

                    </div>
               </section>

               <!-- Footer -->
               <footer>
                    <div>
                         <div>
                              <h1>Lodge Name</h1>
                         </div>
                         <div>
                              <ul>
                                   <li>Home</li>
                                   <li>About Us</li>
                                   <li>Contact Us</li>
                                   <li>Terms and Condition</li>
                                   <li>Privacy Policy</li>
                              </ul>
                         </div>
                         <div>
                              <ul>
                                   <li>Facebook</li>
                                   <li>Whatsapp</li>
                                   <li>Twitter</li>
                                   <li>Instagram</li>
                              </ul>
                         </div>
                    </div>
                    <div>
                         <p>Copyright &copy; 2022 Lodge</p>
                    </div>
               </footer>
          </main>
     </AppLayout>
     
</template>