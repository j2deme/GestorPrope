@php
$carrera = Str::upper(trim($carrera))
@endphp

@switch($carrera)
@case('INGENIERIA EN SISTEMAS COMPUTACIONALES')
ISC
@break
@case('INGENIERIA INDUSTRIAL')
II
@break
@case('INGENIERIA EN GESTION EMPRESARIAL')
IGE
@break
@case('INGENIERIA EN INDUSTRIAS ALIMENTARIAS')
IIA
@break
@case('INGENIERIA AMBIENTAL')
IAMB
@break
@case('INGENIERIA EN AGRONOMIA')
IAGRO
@break
@case('INGENIERIA EN GESTION EMPRESARIAL (MIXTA)')
IGE (M)
@break
@case('INGENIERIA INDUSTRIAL (MIXTA)')
II (M)
@break
@default
{{ $carrera }}
@break
@endswitch