<div class="space-y-10 divide-y divide-gray-900/10">
  <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
    <div class="px-4 sm:px-0">
      <h2 class="text-base font-semibold leading-7 text-gray-900">Travel Plans</h2>
      <p class="mt-1 text-sm leading-6 text-gray-600">Tell us about your travel preferences.</p>
    </div>

    <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
      <div class="px-4 py-6 sm:p-8">
        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="col-span-full">
            <fieldset>
              <legend class="text-sm font-semibold leading-6 text-gray-900">What's the current timetable for your trip?</legend>
              <p class="mt-1 text-sm leading-6 text-gray-600">Select the option that best applies</p>
              <div class="mt-6 space-y-6">
                <div class="flex items-center gap-x-3">
                  <input id="timetable-specific" name="timetable" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                  <label for="timetable-specific" class="block text-sm font-medium leading-6 text-gray-900">I have specific dates</label>
                </div>
                <div class="flex items-center gap-x-3">
                  <input id="timetable-general" name="timetable" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                  <label for="timetable-general" class="block text-sm font-medium leading-6 text-gray-900">I have a general timeframe</label>
                </div>
                <div class="flex items-center gap-x-3">
                  <input id="timetable-undecided" name="timetable" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                  <label for="timetable-undecided" class="block text-sm font-medium leading-6 text-gray-900">I haven't decided yet</label>
                </div>
              </div>
            </fieldset>
          </div>
        </div>
      </div>
      <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Previous</button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Next</button>
      </div>
    </form>
  </div>

  <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
    <div class="px-4 sm:px-0">
      <h2 class="text-base font-semibold leading-7 text-gray-900">Travel Dates</h2>
      <p class="mt-1 text-sm leading-6 text-gray-600">Specify your preferred travel dates.</p>
    </div>

    <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
      <div class="px-4 py-6 sm:p-8">
        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="col-span-full">
            <fieldset>
              <legend class="text-sm font-semibold leading-6 text-gray-900">When would you like to take your trip?</legend>
              <p class="mt-1 text-sm leading-6 text-gray-600">Select the time you're most likely to travel</p>
              <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-5">
                <div class="flex items-center gap-x-3">
                  <input id="summer-2024" name="travel-time" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                  <label for="summer-2024" class="block text-sm font-medium leading-6 text-gray-900">
                    <span class="block text-sm text-gray-500">Summer</span>
                    <span class="block font-semibold">2024</span>
                  </label>
                </div>
                <!-- Add more options here -->
              </div>
            </fieldset>
          </div>

          <div class="sm:col-span-4">
            <label for="departure-date" class="block text-sm font-medium leading-6 text-gray-900">When do you want to leave?</label>
            <div class="mt-2">
              <input type="date" name="departure-date" id="departure-date" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="col-span-full">
            <label for="trip-length" class="block text-sm font-medium leading-6 text-gray-900">How long do you want your trip to be?</label>
            <p class="mt-1 text-sm leading-6 text-gray-600">Select your ideal trip length</p>
            <div class="mt-2">
              <input type="range" name="trip-length" id="trip-length" min="4" max="30" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
            </div>
            <div class="mt-1 flex justify-between text-xs text-gray-600">
              <span>4 days</span>
              <span>30 days</span>
            </div>
          </div>
        </div>
      </div>
      <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Previous</button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Next</button>
      </div>
    </form>
  </div>

  <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
    <div class="px-4 sm:px-0">
      <h2 class="text-base font-semibold leading-7 text-gray-900">Trip Details</h2>
      <p class="mt-1 text-sm leading-6 text-gray-600">Tell us more about your preferences for the trip.</p>
    </div>

    <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
      <div class="px-4 py-6 sm:p-8">
        <div class="max-w-2xl space-y-10">
          <fieldset>
            <legend class="text-sm font-semibold leading-6 text-gray-900">What's most important for your trip?</legend>
            <p class="mt-1 text-sm leading-6 text-gray-600">Select all that apply</p>
            <div class="mt-6 space-y-6">
              <div class="relative flex gap-x-3">
                <div class="flex h-6 items-center">
                  <input id="custom-itinerary" name="trip-importance" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                </div>
                <div class="text-sm leading-6">
                  <label for="custom-itinerary" class="font-medium text-gray-900">Custom itinerary</label>
                </div>
              </div>
              <!-- Add more checkboxes here -->
            </div>
          </fieldset>

          <fieldset>
            <legend class="text-sm font-semibold leading-6 text-gray-900">Which regions would you like to visit?</legend>
            <p class="mt-1 text-sm leading-6 text-gray-600">Select as many as you'd like</p>
            <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-4">
              <div class="relative flex gap-x-3">
                <div class="flex h-6 items-center">
                  <input id="rome" name="regions" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                </div>
                <div class="text-sm leading-6">
                  <label for="rome" class="font-medium text-gray-900">Rome</label>
                </div>
              </div>
              <!-- Add more checkboxes here -->
            </div>
          </fieldset>
        </div>
      </div>
      <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
        <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Previous</button>
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Next</button>
      </div>
    </form>
  </div>

  <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
    <div class="px-4 sm:px-0">
      <h2 class="text-base font-semibold leading-7 text-gray-900">Contact Info</h2>
      <p class="mt-1 text-sm leading-6 text-gray-600">Provide your contact information so we can reach you.</p>
    </div>

    <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
      <div class="px-4 py-6 sm:p-8">
        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
            <div class="mt-2">
              <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="sm:col-span-3">
            <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
            <div class="mt-2">
              <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
              <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="sm:col-span-4">
            <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Phone</label>
            <div class="mt-2">
              <input id="phone" name="phone" type="tel" autocomplete="tel" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="col-span-full">
            <label for="message" class="block text-sm font-medium leading-6 text-gray-900">How can we make your trip to Italy perfect?</label>
            <div class="mt-2">
              <textarea id="message" name="message" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring