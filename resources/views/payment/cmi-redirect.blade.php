<form id="cmiForm" action="{{ $action }}" method="{{ $method }}">
    @foreach($fields as $name => $value)
    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    @endforeach
</form>
<script>
    document.getElementById('cmiForm').submit();
</script>
