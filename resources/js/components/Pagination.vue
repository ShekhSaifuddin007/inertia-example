<template>
    <div class="link-wrap">
        <template v-for="(link, key) in links">
            <div v-if="link.url === null" :key="key" class="links border rounded text-gray-400" :class="{ 'ml-auto': link.label === 'Next' }">{{ link.label }}</div>
            <inertia-link v-else :key="key" class="links border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active, 'ml-auto': link.label === 'Next' }" :href="link.url">{{ link.label }}</inertia-link>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        links: Array,
    },
}
</script>

<style scoped>
    .link-wrap {
        display: flex;
        flex-wrap: wrap;
        margin-top: 1.5rem;
        margin-bottom: -0.25rem;
    }
    .links {
        margin-right: 0.25rem;
        margin-bottom: 0.25rem;
        padding: 5px 7px;
        font-size: 14px;
    }
    .links:hover {
        background: #fff;
        text-decoration: none;
    }
    .links:focus {
        border-color: #667eea;
        color: #667eea;
    }
</style>
