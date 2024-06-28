<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación de Profesores</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <center>
                    <h3>Evaluación de jefe inmediato</h3>
                </center>
            </div>
            <div class="card-body">
                <p><strong>INSTRUCCIONES:</strong></p>
                <p>Si eres <strong>profesor de tiempo completo</strong>, favor de evaluar a tu director.</p>
                <p>Si eres <strong>profesor de asignatura</strong>, favor de evaluar a tu coordinador o representante de academia.</p>
                <p>Si cuentas con varios <strong>coordinadores o representantes</strong>, favor de contestar la encuesta tantas veces como lo requieras.</p>

                <form>               
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="btn-dark">Pregunta</th>
                                <th class="btn-dark">Respuesta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($preguntas) && is_array($preguntas)): ?>
                                <?php foreach($preguntas as $pregunta): ?>
                                    <tr>
                                        <td><?= esc($pregunta['pregunta']) ?></td>
                                        <td>
                                            <?php if($pregunta['abierta'] == 1): ?>
                                                <input type="text" class="form-control" name="respuesta_<?= esc($pregunta['cve_pregunta']) ?>">
                                            <?php else: ?>
                                                <select class="form-control" name="respuesta_<?= esc($pregunta['cve_pregunta']) ?>">
                                                    <?php foreach($pregunta['respuestas'] as $respuesta): ?>
                                                        <option value="<?= esc($respuesta['cve_respuesta']) ?>"><?= esc($respuesta['respuesta']) ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">No hay preguntas encontradas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Aquí va el script para el mensaje de guardado exitoso -->
                    <div id="liveAlertPlaceholder"></div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                            <button type="button" class="btn btn-success" id="liveAlertBtn">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Script para el mensaje de guardado exitoso
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder');

        const appendAlert = (message, type) => {
            const wrapper = document.createElement('div');
            wrapper.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`,
                `   <div>${message}</div>`,
                '   ',
                '</div>'
            ].join('');

            alertPlaceholder.append(wrapper);

            // Auto-dismiss después de 5 segundos
            setTimeout(() => {
                wrapper.remove();
            }, 5000);
        }

        const alertTrigger = document.getElementById('liveAlertBtn');
        if (alertTrigger) {
            alertTrigger.addEventListener('click', () => {
                appendAlert('Guardado exitosamente', 'success');
            });
        }
    </script>
</body>
</html>
