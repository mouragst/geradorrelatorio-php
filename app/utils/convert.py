import sys
from docx2pdf import convert

# Obter os caminhos dos arquivos de entrada e saída
input_file = sys.argv[1]
output_file = sys.argv[2]

# Converter o arquivo DOCX para PDF
convert(input_file, output_file)