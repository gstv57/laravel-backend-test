@props([
    'status'
])

@switch($status)
    @case('pendente')
        <span class="badge bg-warning text-dark">Pendente</span>
    @break

    @case('processando')
        <span class="badge bg-info text-dark">Processando</span>
    @break

    @case('enviado')
        <span class="text-white badge bg-primary">Enviado</span>
    @break

    @case('entregue')
        <span class="text-white badge bg-success">Entregue</span>
    @break

    @case('arquivado')
        <span class="text-white badge badge-dark">Arquivado</span>
    @break

    @case('cancelado')
        <span class="text-white badge bg-danger">Cancelado</span>
    @break
@endswitch
