@extends('layouts.admin')

@section('title', 'النصوص والفقرات')
@section('page_title', 'إدارة نصوص وصفحات الموقع')

@section('admin_content')

    <div class="max-w-4xl mx-auto">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm ring-1 ring-black/5 p-6 md:p-8 space-y-6 text-right">
            @csrf
            
            <h3 class="text-base font-black text-gray-900 pb-4 border-b border-gray-100 mb-6">تعديل نصوص الصفحة الرئيسية وقصتنا</h3>

            <!-- About us text -->
            <div>
                <label for="about_body" class="block text-xs font-bold text-gray-700 mb-2">فقرة "من نحن" بالرئيسية</label>
                <textarea id="about_body" name="about_body" rows="5" required
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('about_body', $settings['about_body'] ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Vision text -->
                <div>
                    <label for="vision_text" class="block text-xs font-bold text-gray-700 mb-2">نص الرؤية</label>
                    <textarea id="vision_text" name="vision_text" rows="4" required
                              class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('vision_text', $settings['vision_text'] ?? '') }}</textarea>
                </div>

                <!-- Mission text -->
                <div>
                    <label for="mission_text" class="block text-xs font-bold text-gray-700 mb-2">نص الرسالة</label>
                    <textarea id="mission_text" name="mission_text" rows="4" required
                              class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('mission_text', $settings['mission_text'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- Clients intro -->
            <div>
                <label for="clients_intro" class="block text-xs font-bold text-gray-700 mb-2">مقدمة قسم العملاء</label>
                <textarea id="clients_intro" name="clients_intro" rows="3" required
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('clients_intro', $settings['clients_intro'] ?? '') }}</textarea>
            </div>

            <!-- Story overview body -->
            <div>
                <label for="story_overview_body" class="block text-xs font-bold text-gray-700 mb-2">قصتنا - فقرة "كيف بدأت الحكاية"</label>
                <textarea id="story_overview_body" name="story_overview_body" rows="5" required
                          class="w-full bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-900 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent focus:bg-white transition-all resize-none">{{ old('story_overview_body', $settings['story_overview_body'] ?? '') }}</textarea>
            </div>

            <!-- Story overview image -->
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-2">صورة "قصتنا"</label>
                <div class="flex items-center gap-4 flex-wrap">
                    @if(isset($settings['story_overview_image']))
                        <div class="h-24 w-40 rounded-xl overflow-hidden shadow-sm ring-1 ring-black/5 bg-gray-50">
                            <img src="{{ str_starts_with($settings['story_overview_image'], 'images/') ? asset($settings['story_overview_image']) : asset('storage/' . $settings['story_overview_image']) }}" alt="" class="w-full h-full object-cover">
                        </div>
                    @endif
                    <div class="flex-1 min-w-[200px]">
                        <input type="file" id="story_overview_image" name="story_overview_image" accept="image/*"
                               class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 cursor-pointer">
                        <span class="text-[10px] text-gray-400 block mt-1">صيغ الصور المدعومة: PNG, JPG, JPEG, GIF. حجم أقصى: 2 ميغابايت.</span>
                    </div>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="pt-4 border-t border-gray-100 flex justify-start">
                <button type="submit" class="bg-brand hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-brand/20 transition-all text-sm">
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>

@endsection
