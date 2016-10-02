import requests
import csv
import time


class FBM():
	def __init__(self, url, token=None):
		self.url = url
		self.token = token
		self.session = requests.Session()

	def auth(self, user, password):
		# headers = {'User-Agent': 'Mozilla/5.0'}
		payload = {
			'username': user,
			'password': password,
			'location': '1',
			'action': 'Login'
		}
		self.session.post('https://' + self.url + '/login/', data=payload)

	def GetDonors(self):
		try:
			return self.donor_table
		except AttributeError:
			payload = {
				'fileName': "",
				'col[donors.donors_79fe2d07e8]': '1',
				'col[donors.firstName]': '1',
				'col[donors.middleName]': '1',
				'col[donors.lastName]': '1',
				'col[donors.donors_e0feeaff84]': '1',
				'col[donors.donors_730b308554]': '1',
				'col[donors.donors_b4d4452788]': '1',
				'col[donors.streetAddress]': '1',
				'col[donors.city]': '1',
				'col[donors.zipCode]': '1',
				'col[donors.donors_6213775871]': '1',
				'col[donations.donationTypeSum]': '1',
				'conditions[type]': 'And',
				'conditions[1][field]': 'donors.created_at',
				'conditions[1][action]': 'dlte',
				'conditions[1][value]': time.strftime('%Y-%m-%d'),
				'conditions[1][id]': '1',
				'conditions[1][blockType]': 'item',
				'conditions[1][parent]': "",
				'blockCount': '2'
			}
			r = self.session.post('https://' + self.url +
							'/reports/donor/donors/csv/',
							data=payload,
							stream=True)
			r.raw.decode_content = True
			self.donor_table = csv.reader(str(r.raw.data).split('\n'))
		return self.donor_table

	def GetDonations(self):
		try:
			return self.donation_table
		except AttributeError:
			payload = {
				'fileName': '',
				'donation_type': '0',
				'col[donors.id]': '1',
				'col[donors.firstName]': '1',
				'col[donors.middleName]': '1',
				'col[donors.lastName]': '1',
				'col[donors.donors_e0feeaff84]': '1',
				'col[donors.donors_b4d4452788]': '1',
				'col[donors.city]': '1',
				'col[donors.state]': '1',
				'col[donors.zipCode]': '1',
				'col[donors.created_at]': '1',
				'col[donors.donors_6213775871]': '1',
				'col[donations.donationType_id]': '1',
				'col[donations.donations_1b458b4e6a]': '1',
				'col[donations.donation_at]': '1',
				'col[donations.donations_41420c6893]': '1',
				'col[donations.donations_f695e975c6]': '1',
				'conditions[type]': 'And',
				'conditions[1][field]': 'donations.donation_at',
				'conditions[1][action]': 'dlte',
				'conditions[1][value]': time.strftime('%Y-%m-%d'),
				'conditions[1][id]': '1',
				'conditions[1][blockType]': 'item',
				'conditions[1][parent]': '',
				'blockCount': '2'
			}
			r = self.session.post('https://' + self.url +
							'/reports/donor/donations/csv/',
							data=payload,
							stream=True)
			r.raw.decode_content = True
			self.donation_table = csv.reader(str(r.raw.data).split('\n'))
		return self.donation_table

	def PostDonation(self, D_id, dollars, pounds, D_type):
		donation_type = [
			"Individual Donor",
			"Churches/Places of Worship",
			"Grants/Foundations",
			"Business/Corporation/Organization",
			"Fundraising Events",
			"Board of Directors",
			"Recurring Monthly Donation",
			"NTFH Event",
			"Other Revenue"
		]

		payload = {
		'action': 'Save Donation & close',
		'donationType_id': '1',
		'donation_at': time.strftime('%Y-%m-%d'),
		'donations_1b458b4e6a': donation_type[D_type],
		'donations_e0a1fae0a3': dollars,
		'donations_f695e975c6': pounds
		}

		r = self.session.post('https://' + self.url +
						'/create-new-donation/create/did:' + str(D_id) + '/',
						data=payload)
		return r.status_code
