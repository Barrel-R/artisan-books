<script setup lang="ts">
import { ref, computed } from 'vue';
import BookCard from './BookCard.vue';
import BookTabs from './BookTabs.vue';
import BookshelfFooter from './BookshelfFooter.vue';
import BookModal from './BookModal.vue';

interface Book {
    id: number;
    title: string;
    description: string;
    extendedDescription: string;
    coverImage: string;
    price: string;
    age: string;
    pages: number;
    backgroundColor: string;
    previewImages: string[];
    materials: string;
    dimensions: string;
    manufacturingTime: string;
}

const selectedBook = ref<Book | null>(null);
const showModal = ref(false);

const openModal = (book: Book) => {
    selectedBook.value = book;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

const tabs = [
    { label: 'Todos os livros', value: 'all' },
    { label: 'Idades 3-6', value: 'age3-6' },
    { label: 'Idades 4-8', value: 'age4-8' },
    { label: 'Novidades', value: 'new' }
];

const activeTab = ref('all');

const books: Book[] = [
    {
        id: 1,
        title: "Forest Friends Adventure",
        description: "Join the woodland creatures on a magical journey through the enchanted forest.",
        extendedDescription: "This handcrafted book features adorable woodland creatures made from premium felt and eco-friendly fabrics. Each page tells a story of friendship and adventure as the animals explore their forest home. The tactile elements encourage sensory development while the charming illustrations captivate young imaginations.",
        coverImage: "https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fmarketplace.canva.com%2FEAD7YHrjZYY%2F1%2F0%2F1003w%2Fcanva-blue-illustrated-stars-children%27s-book-cover-haFtaSNXXF4.jpg&f=1&nofb=1&ipt=ac3356a9c8e4b120341ce68237b6dad7d815640189c253bb9f4f3b001adf6c92&ipo=images",
        price: "R$ 24,99",
        age: "3-6 anos",
        pages: 24,
        backgroundColor: "bg-blue-100",
        previewImages: [
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600"
        ],
        materials: "Felt, organic cotton, recycled paper, non-toxic paints",
        dimensions: "8.5 x 8.5 inches (21.5 x 21.5 cm)",
        manufacturingTime: "3-4 weeks"
    },
    {
        id: 2,
        title: "Ocean Explorers",
        description: "Dive deep into the sea and discover the colorful world beneath the waves.",
        extendedDescription: "Explore the wonders of the ocean with this beautifully crafted underwater adventure. Each page features shimmering fabrics and textured elements that bring sea creatures to life. Children will love discovering hidden details and learning about ocean habitats through tactile exploration and engaging storytelling.",
        coverImage: "/placeholder.svg?height=300&width=240",
        price: "R$ 26,99",
        age: "4-8 anos",
        pages: 28,
        backgroundColor: "bg-pink-200",
        previewImages: [
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600"
        ],
        materials: "Waterproof fabrics, holographic details, recycled materials",
        dimensions: "9 x 9 inches (23 x 23 cm)",
        manufacturingTime: "4-5 weeks"
    },
    {
        id: 3,
        title: "Sky High Dreams",
        description: "Soar through the clouds with friendly birds and magical flying creatures.",
        extendedDescription: "This whimsical book takes children on a journey through the sky, where they'll meet friendly birds and discover the magic of flight. Featuring cloud-soft textures and delicate details, each page encourages imagination and wonder. The lightweight design makes it perfect for bedtime reading and daytime adventures.",
        coverImage: "/placeholder.svg?height=300&width=240",
        price: "R$ 22,99",
        age: "2-5 anos",
        pages: 20,
        backgroundColor: "bg-blue-200",
        previewImages: [
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600"
        ],
        materials: "Cotton, silk, feather details, cloud-textured fabrics",
        dimensions: "8 x 8 inches (20 x 20 cm)",
        manufacturingTime: "2-3 weeks"
    },
    {
        id: 4,
        title: "Dinosaur Discovery",
        description: "Travel back in time and meet the gentle giants of the prehistoric world.",
        extendedDescription: "Embark on a prehistoric adventure with this tactile dinosaur book. Each page features textured dinosaurs that children can touch and explore. The educational content introduces young readers to different dinosaur species while the interactive elements keep them engaged. Sturdy construction ensures this book will withstand enthusiastic handling.",
        coverImage: "/placeholder.svg?height=300&width=240",
        price: "R$ 27,99",
        age: "5-9 anos",
        pages: 32,
        backgroundColor: "bg-pink-100",
        previewImages: [
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600"
        ],
        materials: "Textured fabrics, leather-like details, reinforced binding",
        dimensions: "10 x 8 inches (25 x 20 cm)",
        manufacturingTime: "4-6 weeks"
    },
    {
        id: 5,
        title: "Magical Garden",
        description: "Explore a garden filled with magical plants and friendly creatures.",
        extendedDescription: "Step into an enchanted garden where flowers bloom with magic and tiny creatures hide among the leaves. This sensory-rich book features fabric flowers with different textures, scented pages, and pop-up elements that create a truly immersive experience. Perfect for developing fine motor skills and encouraging a love of nature.",
        coverImage: "/placeholder.svg?height=300&width=240",
        price: "R$ 23,99",
        age: "3-7 anos",
        pages: 24,
        backgroundColor: "bg-blue-100",
        previewImages: [
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600"
        ],
        materials: "Fabric flowers, scented pages, recycled paper",
        dimensions: "9 x 9 inches (23 x 23 cm)",
        manufacturingTime: "3-4 weeks"
    },
    {
        id: 6,
        title: "Bedtime Stories",
        description: "A collection of soothing stories to help little ones drift off to sleep.",
        extendedDescription: "This gentle collection of bedtime tales is designed to calm active minds and prepare children for sleep. Featuring soft, muted colors and glow-in-the-dark details that create a magical nighttime experience. The stories focus on peaceful themes and restful adventures, making this the perfect addition to any bedtime routine.",
        coverImage: "/placeholder.svg?height=300&width=240",
        price: "R$ 25,99",
        age: "2-6 anos",
        pages: 28,
        backgroundColor: "bg-pink-200",
        previewImages: [
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600"
        ],
        materials: "Ultra-soft fabrics, glow-in-the-dark elements, satin binding",
        dimensions: "8 x 8 inches (20 x 20 cm)",
        manufacturingTime: "3-5 weeks"
    },
    {
        id: 7,
        title: "Jungle Adventures",
        description: "Discover the wonders of the jungle with friendly animal guides.",
        extendedDescription: "Journey deep into the jungle with this vibrant, interactive book. Each page reveals a new jungle habitat with textured vines, hidden animals, and surprising pop-up elements. The rich illustrations and engaging narrative encourage exploration while teaching children about jungle ecosystems and the animals that call them home.",
        coverImage: "/placeholder.svg?height=300&width=240",
        price: "R$ 26,99",
        age: "4-8 anos",
        pages: 30,
        backgroundColor: "bg-blue-200",
        previewImages: [
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600"
        ],
        materials: "Textured fabrics, wood elements, sustainable materials",
        dimensions: "9.5 x 9.5 inches (24 x 24 cm)",
        manufacturingTime: "4-5 weeks"
    },
    {
        id: 8,
        title: "Farm Friends",
        description: "Meet the friendly animals who live on Sunshine Farm.",
        extendedDescription: "This delightful farm-themed book introduces young children to friendly farm animals through simple stories and tactile elements. Each animal has a different texture to touch and explore, helping children develop sensory awareness while learning about farm life. The chunky pages are perfect for little hands to turn independently.",
        coverImage: "https://img.freepik.com/free-vector/child-like-adventures-book-cover_23-2149320641.jpg?t=st=1743343174~exp=1743346774~hmac=e9d686790f2d9f97a5709776afac1f859547c2420e95da87349d072491f7669d&w=740",
        price: "R$ 24,99",
        age: "1-4 anos",
        pages: 18,
        backgroundColor: "bg-pink-100",
        previewImages: [
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600",
            "/placeholder.svg?height=400&width=600"
        ],
        materials: "Washable fabrics, child-safe materials, reinforced binding",
        dimensions: "7 x 7 inches (18 x 18 cm)",
        manufacturingTime: "2-3 weeks"
    }
];

const filteredBooks = computed(() => {
    switch (activeTab.value) {
        case 'age3-6':
            return books.filter(book => book.age.includes('3-6') || book.age.includes('2-5'));
        case 'age4-8':
            return books.filter(book => book.age.includes('4-8') || book.age.includes('5-9'));
        case 'new':
            return books.slice(0, 4);
        default:
            return books;
    }
});
</script>

<template>
    <div class="container px-4 py-12 mx-auto">
        <BookTabs :tabs="tabs" :activeTab="activeTab" @update:activeTab="(value) => activeTab = value" />

        <div class="grid gap-15 md:grid-cols-2 lg:grid-cols-3">
            <BookCard v-for="book in filteredBooks" :key="book.id" :book="book" @view-details="openModal(book)" />
        </div>

        <BookModal v-if="selectedBook" :book="selectedBook" :show="showModal" @close="closeModal" />

        <BookshelfFooter />
    </div>
</template>
