@if ($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
        <div style="display: flex; align-items: center; margin-bottom: 10px;">
            <span style="font-size: 20px; margin-right: 10px;">⚠️</span>
            <strong>Veuillez corriger les erreurs suivantes :</strong>
        </div>
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li style="margin-bottom: 5px;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
