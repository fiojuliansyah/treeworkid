<div>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" wire:model.live="search" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Activity" />
            </div>
        </div>
    </div>
    <div class="card-body py-4 table-responsive">
        <table class="table align-middle table-row-dashed fw-semibold text-gray-600 fs-6 gy-5" id="kt_table_customers_logs">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Log</th>
                    <th class="min-w-125px">Name</th>
                    <th class="min-w-125px">Attribe</th>
                    <th class="min-w-125px">Old</th>
                    <th class="min-w-125px"></th>
                </tr>
            </thead
            <tbody>
                @foreach ($activities as $activity) 
                    @php
                        $properties = json_decode($activity->properties);
                        $attributes = (array)($properties->attributes ?? []);
                        $old = (array)($properties->old ?? []);
                        
                        // Find keys that have changed
                        $changedKeys = array_diff_assoc($attributes, $old);
                    @endphp
                    
                    @if(!empty($changedKeys))
                        <tr>
                            <!--begin::Badge=-->
                            <td class="min-w-70px">
                                <div class="badge badge-light-warning">{{ $activity->description }}</div>
                            </td>
                            <td>
                                {{ $activity->causer['name'] }}
                            </td>
                            <td>
                                <!-- Display only the changed keys and their new values -->
                                @foreach($changedKeys as $key => $newValue)
                                    {{ $key }}: {{ $newValue }} <br>
                                @endforeach
                            </td>
                            <!-- Display old values corresponding to the changed keys -->
                            <td>
                                @foreach($changedKeys as $key => $newValue)
                                    {{ $key }}: {{ $old[$key] }} <br>
                                @endforeach
                            </td>
                            <!--end::Status=-->
                            <!--begin::Timestamp=-->
                            <td class="pe-0 text-end min-w-200px">{{ $activity->created_at->format('d-m-Y') }}</td>
                            <!--end::Timestamp=-->
                        </tr>
                    @endif
                @endforeach                                     
            </tbody>
            <!--end::Table body-->
        </table>
    </div>
</div>
