<script setup>
import { onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import {
    FwbA,
    FwbTable,
    FwbTableBody,
    FwbTableCell,
    FwbTableHead,
    FwbTableHeadCell,
    FwbTableRow,
    FwbButton,
} from "flowbite-vue";
import StatusBadge from "./Partials/StatusBadge.vue";

const page = usePage();

onMounted(() => {
    console.log(page.props.deployments);
});

const deploy = () => {
    console.log("deploy...");
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-4">
                    <div class="col-span-1 shadow-md rounded-lg">
                        <fwb-table>
                            <fwb-table-head>
                                <fwb-table-head-cell>
                                    Name
                                </fwb-table-head-cell>

                                <fwb-table-head-cell>
                                    Status
                                </fwb-table-head-cell>

                                <fwb-table-head-cell>
                                    <span class="sr-only">Action</span>
                                </fwb-table-head-cell>
                            </fwb-table-head>

                            <fwb-table-body>
                                <fwb-table-row
                                    v-for="(deployment, key) in $page.props
                                        .deployments"
                                >
                                    <fwb-table-cell>
                                        {{ deployment.name }}
                                    </fwb-table-cell>
                                    <fwb-table-cell>
                                        <StatusBadge
                                            :value="deployment.status"
                                        />
                                    </fwb-table-cell>
                                    <fwb-table-cell>
                                        <fwb-button
                                            :id="'deploy-button-' + key"
                                            color="default"
                                            size="sm"
                                            pill
                                            @click="deploy"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 640 512"
                                                class="w-5 h-5"
                                            >
                                                <path
                                                    fill="currentColor"
                                                    d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"
                                                />
                                            </svg>
                                        </fwb-button>
                                    </fwb-table-cell>
                                </fwb-table-row>
                            </fwb-table-body>
                        </fwb-table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
