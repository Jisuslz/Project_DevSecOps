{{/*
Genera el nombre completo de un recurso basado en el nombre del release.
*/}}
{{- define "jtl-reporter.fullname" -}}
{{- printf "%s-%s" .Release.Name .Chart.Name | trunc 63 | trimSuffix "-" -}}
{{- end }}

{{/*
Genera etiquetas comunes para todos los recursos.
*/}}
{{- define "jtl-reporter.labels" -}}
app.kubernetes.io/name: {{ .Chart.Name }}
app.kubernetes.io/instance: {{ .Release.Name }}
app.kubernetes.io/version: {{ .Chart.AppVersion }}
app.kubernetes.io/managed-by: {{ .Release.Service }}
{{- end }}
