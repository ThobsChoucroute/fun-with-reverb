<script setup>
import { computed } from "vue";

const props = defineProps({
    value: {
        required: true,
    },
});

const badgeColor = computed(() => {
    let badgeClasses = "";

    switch (props.value) {
        case "installing":
        case "installing_composer":
        case "installing_npm":
        case "installing_env":
            badgeClasses =
                "bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300";
            break;

        case "installed":
            badgeClasses =
                "bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300";
            break;

        default:
            badgeClasses =
                "bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300";
            break;
    }

    return badgeClasses;
});
</script>

<template>
    <div class="flex">
        <span
            class="text-sm font-medium px-2.5 py-0.5 rounded-full flex items-center space-x-1 justify-center"
            :class="badgeColor"
        >
            <span>
                {{ props.value }}
            </span>
        </span>
    </div>
</template>
