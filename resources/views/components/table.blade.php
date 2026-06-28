@props(['header' => ''])

<div class="flex flex-col">
  <div class="-m-1.5 overflow-x-auto">
    <div class="p-1.5 min-w-full inline-block align-middle">
      <div class="overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-gray-50 dark:bg-gray-700">
            {{ $header }}
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
            {{ $slot }}
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<style>
  table thead th { padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 600; text-transform: uppercase; color: #6b7280; letter-spacing: 0.05em; }
  table tbody td { padding: 12px 16px; font-size: 13px; color: #374151; vertical-align: middle; }
  table tbody tr:hover td { background-color: #f9fafb; }
</style>
