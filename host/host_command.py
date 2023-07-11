from http.server import BaseHTTPRequestHandler, HTTPServer
import os
from urllib.parse import parse_qs, urlparse
import subprocess

class RequestHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        query = urlparse(self.path).query
        params = parse_qs(query)
        command = params.get('command', [''])[0]
        result = subprocess.run(f"osascript -e 'display dialog \"Authorize command: {command}?\" buttons {{\"Yes\", \"No\"}} default button \"No\"' -e 'if the button returned of the result is \"Yes\" then do shell script \"{command}\"'", shell=True, capture_output=True, text=True)
        self.send_response(200)
        self.send_header('Content-type', 'text/plain')
        self.end_headers()
        self.wfile.write(result.stdout.encode())

def run(server_class=HTTPServer, handler_class=RequestHandler):
    server_address = ('', 8080)
    httpd = server_class(server_address, handler_class)
    httpd.serve_forever()

if __name__ == '__main__':
    run()

# TODO: Linux support
# TODO: return the output of the executed command
# TODO: ensure the command doesn't wait for user input or it will hang
# TODO: handle timeouts better
# TODO: maybe support async commands, notifying the user somehow
# TODO: check escaping / encoding of command