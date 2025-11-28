import sys
from docx2pdf import convert

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python convert.py <input_docx> <output_pdf>")
        sys.exit(1)
    
    input_file = sys.argv[1]
    output_file = sys.argv[2]
    
    try:
        convert(input_file, output_file)
        print(f"Successfully converted {input_file} to {output_file}")
        sys.exit(0)
    except Exception as e:
        print(f"Error converting file: {str(e)}")
        sys.exit(1)