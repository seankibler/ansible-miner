import json
from urllib2 import Request, urlopen, URLError

miner_api = "http://localhost:10000/api.json"
statuscake_push_url = "https://push.statuscake.com/?PK=07e2a55247bbe50&TestID=4022995&time=0"

try:
	miner_api_response = urlopen(miner_api)
	miner_api_data = json.loads(miner_api_response.read())
	if miner_api_data['hashrate']['total'][0] > 1500:
		statuscake_response = urlopen(statuscake_push_url)
except URLError as e:
	if hasattr(e, 'reason'):
		print 'Failed to reach server. Reason: ', e.reason
	elif hasattr(e, 'code'):
		print 'Server could not handle the request. Code: ', e.code
