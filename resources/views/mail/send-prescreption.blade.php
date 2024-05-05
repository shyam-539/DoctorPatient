<x-mail::message>
# Prescription

Here is your Prescription for {{ $prescriptionDetails->specialization }} by Doctor {{ $prescriptionDetails->doctor_name }}

Medicinal Prescription: {{ $prescriptionDetails->medicinal_prescription }}

Medical Advice: {{ $prescriptionDetails->medical_advices }}

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

