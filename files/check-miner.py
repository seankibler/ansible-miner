import json
import requests
import re
from urllib2 import Request, urlopen, URLError

miner_api = "https://web.xmrpool.eu:8119/stats_address?address=4ARdAsVF86DTeWFjZEsd2KFBwjozisRuMiBiqyp9tnM6XLsAKCoXpMWAfCM4SehcxV1NDzgBKXZLoGApEYaQ5NVmUDgHqak"
statuscake_push_url = "https://push.statuscake.com/?PK=07e2a55247bbe50&TestID=4022995&time=0"

try:
	miner_api_response = requests.get(miner_api, verify=False)
	miner_api_data = json.loads(miner_api_response.content)
	hashrate = re.findall('\d+\.\d+', miner_api_data['stats']['hashrate'])

	if hashrate != None:
		hashrate = float(hashrate[0])

	if hashrate >= 2.0:
		statuscake_response = requests.get(statuscake_push_url)
except URLError as e:
	if hasattr(e, 'reason'):
		print 'Failed to reach server. Reason: ', e.reason
	elif hasattr(e, 'code'):
		print 'Server could not handle the request. Code: ', e.code
