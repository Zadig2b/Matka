export async function GET() {
    const res = await fetch('./../../../data.json', {
      headers: {
        'Content-Type': 'application/json',
        'API-Key': process.env.DATA_API_KEY,
      },
    })
    const data = await res.json()
   
    return Response.json({ data })
  }

  export function GET(request) {
    const searchParams = request.nextUrl.searchParams
    const query = searchParams.get('query')
    // query is "hello" for /api/search?query=hello
  }