#include <cstdio>
#include <iostream>
#include <stdlib.h>
#include <iomanip>
#include <algorithm>
#include <time.h>
#include <vector>
#include <queue>
#include <stack>
#include <set>
#include <string>
#include <cmath>
#include <memory.h>
#include <deque>
using namespace std;

#define mp make_pair
#define X first
#define Y second
#define pb push_back
#define CL(x) (x << 1)
#define CR(x) ((x << 1) + 1)
#define sqr(x) ((x) * (x))
#define Task ""

const bool OnLineJudge = 1;

typedef long long cc;
typedef long double ld;
typedef pair <int, int> pt;
const int N = 100005, M = 201;
int color[402][402];
int cnt[16];
cc res;
int n;

int main()
{
    if (!OnLineJudge)
    {
        freopen("input.inp", "r", stdin);
        //freopen(Task".inp", "r",  stdin);
        //freopen(Task".out", "w", stdout);
    }
    //-------------------------------------------------------------------------------------------------------
    scanf("%d\n", &n);
    for (int i = 1; i <= n; i++)
    {
        int u, v, c;
        scanf("%d %d %d\n", &u, &v, &c);
        c = (1 << (c - 1));
        color[u + M][v + M] = c;
    }
    for (int x1 = -200 + M; x1 <= 200 + M; x1++)
        for (int x2 = x1 + 1; x2 <= 200 + M; x2++)
        {
            memset(cnt, 0, sizeof(cnt));
            for (int y = -200 + M; y <= 200 + M; y++)
                if (color[x1][y] && color[x2][y])
                {
                    res += (cnt[15 ^ color[x1][y] ^ color[x2][y]]);
                    cnt[color[x1][y] ^ color[x2][y]]++;
                }
        }
    printf("%lld\n", res);
    //-------------------------------------------------------------------------------------------------------
    return 0;
}
