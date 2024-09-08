<script setup>
import { onMounted, ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage, useForm, router } from "@inertiajs/vue3";
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
import DeployButton from "./Partials/DeployButton.vue";

const page = usePage();
const form = useForm({});

const deployments = ref();

onMounted(() => {
    deployments.value = page.props.deployments;

    deployments.value.forEach((deployment) => {
        if (deployment.pending) {
            listener(deployment, deployment.id);
        }
    });
});

const deploy = (id) => {
    let deployment = deployments.value.find(
        (deployment) => deployment.id == id
    );

    form.post(route("deployments.deploy", id), {
        preserveState: true,
        preserveScroll: true,
        onStart: () => {
            deployment.pending = true;

            listener(deployment, id);
        },
    });
};

const listener = (deployment, id) => {
    Echo.channel("deployments." + id).listen(
        ".deployments.updated",
        (event) => {
            deployment.status = event.deployment.status;

            if (event.deployment.status == "installed") {
                Echo.leaveChannel("deployments." + id);

                deployment.pending = false;
            }
        }
    );
};
</script>

<template>
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
                                    v-for="deployment in deployments"
                                    :key="deployment.id"
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
                                        <DeployButton
                                            @click="deploy(deployment.id)"
                                            :id="
                                                'deploy-button-' + deployment.id
                                            "
                                            :loading="deployment.pending"
                                        />
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
