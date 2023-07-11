from flask import Flask, request
from flask.json import jsonify
import subprocess

app = Flask(__name__)

# In-memory dictionary to store secrets
secrets = {}

@app.route('/secret', methods=['GET'])
def get_secret():
    secret_name = request.args.get('name')
    if secret_name in secrets:
        # If the secret is already stored, return it
        return jsonify({secret_name: secrets[secret_name]})
    else:
        # If the secret is not stored, prompt the user for it
        secret_value = subprocess.getoutput(f'osascript -e "display dialog \\"Enter the {secret_name}\\" default answer \\"\\" with hidden answer" -e "text returned of result"')
        secrets[secret_name] = secret_value
        return secret_value

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=8080)

# TODO: Linux support