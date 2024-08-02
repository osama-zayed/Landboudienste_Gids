<div class="modal fade" id="show_more{{ $Incident->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">تفاصيل البلاغ
                    رقم: {{ $Incident->incident_number }}</h5> 

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>رقم البلاغ: <span class="text-info">{{ $Incident->incident_number }}</span></p>
                <p>نوع الجريمة: <span class="text-info">{{ $Incident->crimeType->name }}</span></p>
                <p>تاريخ البلاغ: <span class="text-info">{{ $Incident->incident_date }}</span></p>
                <p>مركز الشرطة: <span class="text-info">{{ $Incident->department->name }}</span></p>
                <p>زمن وقوع الجريمة: <span class="text-info">{{ $Incident->incident_time }}</span></p>
                <p>تاريخ وقوع الجريمة: <span class="text-info">{{ $Incident->date_occurred }}</span></p>
                <p>مكان وقوع الجريمة: <span class="text-info">{{ $Incident->incident_location }}</span></p>
                <p>الأسباب والدوافع: <span class="text-info">{{ $Incident->reasons_and_motives }}</span></p>
                <p>الأدوات المستخدمة: <span class="text-info">{{ $Incident->tools_used }}</span></p>
                <p>عدد الجناة: <span class="text-info">{{ $Incident->number_of_perpetrators }}</span></p>
                <p>عدد الضحايا: <span class="text-info">{{ $Incident->number_of_victims }}</span></p>
                <p>الحالة: <span class="text-info">{{ $Incident->incident_status }}</span></p>
                <p>شرح البلاغ: <span class="text-info">{{ $Incident->incident_description }}</span></p>
                @if ($Incident->incident_image)
                    <p>الصورة النهائية للبلاغ: <a href="{{ asset($Incident->incident_image) }}" class="text-info"
                            target="_blank">عرض </a> |
                        <a href="{{ asset($Incident->incident_image) }}" class="text-info" download>تنزيل</a>
                    </p>
                @endif
                @if ($Incident->notes)
                    <p>ملاحظات: <span class="text-info">{{ $Incident->notes }}</span></p>
                @endif
    
            </div>
            <div class="modal-footer">
                <a href="{{ route('Incident.show', $Incident->id) }}" class="btn btn-info " >عرض تغيرات حاله البلاغ</a> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>

            </div>
        </div>
    </div>
</div>
