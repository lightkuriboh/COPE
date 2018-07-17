#include<bits/stdc++.h>
#define up(i,a,b) for(int i=int(a);i<=int(b);i++)
#define down(i,a,b) for(int i=int(a);i>=int(b);i--)
#define f first
#define s second
#define pb push_back
/*----------------------------------------------*/
using namespace std;
typedef long long ll;
typedef vector<int> vi;
typedef vector<vi> vvi;
typedef pair<int, int> pii;
typedef pair<ll, int> pli;
typedef vector<pii> vii;
typedef set<int> si;
typedef map<int, int> mii;
/*----------------------------------------------*/
const int maxn=1e6+10;
const int maxt=2e5+10;
const ll inf=1e16;
const int mod=111539786;
const double pi=4*atan(1);
const bool OnlineJudge=1;
const int mxs=2;
const int as=2e2;
/*----------------------------------------------*/
struct cord{
    int x,y;
};
/*----------------------------------------------*/

int n;
cord a[maxn];
int c[maxn];
int fxy[500][500];
long long f[16];
long long kq;

inline void init(){
    cin>>n;
    up(i,1,n){
        cin>>a[i].x>>a[i].y>>c[i];
        fxy[a[i].x+as][a[i].y+as]=1<<(c[i]-1);
    }
}

inline void prepare(){
    up(i,0,400)
    up(j,0,i){
        up(i,0,15) f[i]=0;
        up(k,0,400){
            if(fxy[i][k]!=0&&fxy[j][k]!=0&&fxy[i][k]!=fxy[j][k]){
                int color=(fxy[i][k]|fxy[j][k]);
                kq+=f[15^color];
                f[color]++;
            }
        }
    }
}

inline void solve(){
    cout<<kq;
}

inline void file(){
    #define task "RECTCOLOR"
    ios_base::sync_with_stdio(false);
    cin.tie(NULL); cout.tie(NULL);
    freopen(task".INP","r",stdin);
    freopen(task".OUT","w",stdout);
}

int main(){
    if(!OnlineJudge) file();
    init();
    prepare();
    //while(k--)
    solve();
    return 0;
}
